@if ($message = session()->get('success'))
<div id="toastwithcheese" class="text-center text-white rounded-md bg-gray-800">
  <p class="px-6 py-3">
      <a class="close mr-3 hidden" type="button" onclick="closeToast(event)" data-dismiss="alert">×</a>
      {{ $message }}
  </p>
</div>
@endif


{{-- @push('scripts') --}}
<script>
    (function toast() {
      setTimeout(() => {
        const toast = document.getElementById("toastwithcheese");
        // choose delay
        // const time = 3000; // short

        if(toast){
            const time = 5500; // long
            let timeClass = time == 5500 ? "show2" : "show";
            toast.classList.add(timeClass);
            setTimeout(function(){
            toast.className = toast.className.replace(timeClass, "");
            }, time);
        }

      }, 500);
    })()
    function closeToast(e){
      e.preventDefault();
      e.target.parentElement.classList.remove('show2');
      e.target.parentElement.classList.remove('show');
    }
</script>
{{-- @endpush --}}