@if ($message = session()->get('success'))
<div id="toastwithcheese" class="py-6 text-center text-white rounded-md bg-blue-400">
    <p>
        <a type="button" onclick="closeToast(event)" class="close" data-dismiss="alert">×</a>
        {{ $message }}
    </p>
</div>
@endif


@push('scripts')
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
@endpush