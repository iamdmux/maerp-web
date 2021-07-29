<?php

namespace App\Http\Controllers\Dev;

use Shippo;
use Shippo_Shipment;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DevController extends Controller
{
    public function magazzino(){
        // $slugLength = User::SLUGLENGTH;


        // for ($i=15; $i <=25 ; $i++) { 

        //    $user = User::create([
        //         'id' => $i,
        //         'name' => 'magazzino',
        //         'slug' => Str::random($slugLength),
        //         'email' => "magazzino$i@maerp.app",
        //         'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
        //     ]);
        //     User::find($user->id)->assignRole('resp. magazzino');
        // }

        //     return redirect('/erp')->with('success', 'All good!');
        }

        public function shippo(){
            Shippo::setApiKey(env('SHIPPO_TEST_API'));

            $delivery_windows = array(1, 3, 7);
            $destination_zip_codes = array('10007', '60290', '95122');	
                
            // Example from_address array
            // The complete refence for the address object is available here: https://goshippo.com/docs/reference#addresses
            $from_address = array(
                'name' => 'Mr Hippo',
                'company' => 'Shippo',
                'street1' => '215 Clayton St.',
                'city' => 'San Francisco',
                'state' => 'CA',
                'zip' => '94117',
                'country' => 'US',
                'phone' => '+1 555 341 9393',
                'email' => 'mr-hippo@goshipppo.com',
            );

            // Parcel information array
            // The complete reference for parcel object is here: https://goshippo.com/docs/reference#parcels
            $parcel = array(
                'length'=> '5',
                'width'=> '5',
                'height'=> '5',
                'distance_unit'=> 'in',
                'weight'=> '2',
                'mass_unit'=> 'lb',
            );


            // Collect the shipments to each address
            $shipments = array();
            foreach ($destination_zip_codes as $zip_code)
            {
                // Example to_address with the zip code
                // The complete refence for the address object is available here: https://goshippo.com/docs/reference#addresses
                $to_address = array(
                    'country' => 'US',
                    'zip' => $zip_code,
                );
                
                // For each destination address we now create a Shipment object.
                // async=false indicates that the function will wait until all rates are generated before it returns.
                // The reference for the shipment object is here: https://goshippo.com/docs/reference#shipments
                // By default Shippo API operates on an async basis. You can read about our async flow here: https://goshippo.com/docs/async
                $shipments[] = Shippo_Shipment::create(array(
                    'address_from'=> $from_address,
                    'address_to'=> $to_address,
                    'parcels'=> array($parcel),
                    'async'=> false
                ));
            }

            // Collect all shipments rates
            $all_rates = array();
            foreach ($shipments as $shipment) {
                $all_rates = array_merge($all_rates, $shipment['rates']);
            }

            // This function takes a list of $rates, filters only those rates in
            // the $delivery_window, and returns the rates estimation
            function calculate_rates_estimation($rates, $delivery_window) {
                // Filter rates by delivery window
                $eligible_rates = array_values(array_filter(
                    $rates,
                    function($rate) use($delivery_window){
                        return $rate['days'] <= $delivery_window;
                    }
                ));

                // Calculate estimations on the eligible_rates
                $min = $eligible_rates[0]['amount'];
                $max = 0.0;
                $sum = 0.0;
                foreach ($eligible_rates as $rate) {
                    $amount = $rate['amount'];

                    $min = min($min, $amount);
                    $max = max($max, $amount);
                    $sum += $amount;
                }

                return array(
                    'delivery_window' => $delivery_window,
                    'min' => $min,
                    'max' => $max,
                    'average' => $sum / count($eligible_rates),
                );
            }

            // Show estimations for each delivery window
            foreach ($delivery_windows as $delivery_window) {
                $estimations = calculate_rates_estimation($all_rates, $delivery_window);

                echo "For a delivery window of {$delivery_window} days:" . "<br>";
                echo "--> " . "Min. costs: " . $estimations['min'] . "<br>";
                echo "--> " . "Max. costs: " . $estimations['max'] . "<br>";
                echo "--> " . "Avg. costs: " . $estimations['average'] . "<br>";
            }
        }
    
}
