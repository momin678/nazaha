<section class="mb-4">
   <div class="container">
      <div class="shadow-sm">
         <div class="text-capitalize d-flex mb-3 align-items-baseline border-bottom">
            <h3 class="text-capitalize h5 fw-700 mb-0">
               <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">Inspired by Your Choice</span>
            </h3>
            {{-- <a href="javascript:void(0)" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('Top 18') }}</a> --}}
         </div>
         <div class="container">
            {{ csrf_field() }}
            <div id="post_data" class="row post_data">
            </div>
         </div>
      </div>
   </div>
</section>
<script>
   $(document).ready(function(){
        var _token = $('input[name="_token"]').val();
        load_data('', _token);
        function load_data(id="", _token)
        {
            $.ajax({
               url:"{{ route('home.section.load_data') }}",
               method:"POST",
               data:{id:id, _token:_token},
               success:function(data){
                    $('#load_more_button').remove();
                    $('.post_data').append(data);
                }
            })
        }
   
       $(document).on('click', '#load_more_button', function(){
            var id = $(this).data('id');
            $('#load_more_button').html('<b>Loading...</b>');
            load_data(id, _token);
            
        });
   });
   
   
</script>