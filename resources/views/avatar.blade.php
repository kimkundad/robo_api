<style>
   
    .data-background-image-login {
    background-image: url('{{ url('img/BG@2x.png') }}');
    background-size: cover;
    background-position: 50%;
    background-color: #00326a;
}
</style>
<div class="container data-background-image-login" style="width:100%; height:100%">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">Dashboard</div>

                <div class="card-body">
                    


        <form class="forms-sample " id="myForm" method="POST" action="{{ url('/update_profile_avatar') }}" enctype="multipart/form-data">
            <div class="form-group">
            
                <input type="text" class="form-control"  name="token" value="eyJhbGciOiJSUzI1NiIsImtpZCI6IjE5OEI5NTVGNTlENzE1RjE0QUI5QjcxQkFBQzhBMzBDMzg5MkNFMjQiLCJ0eXAiOiJhdCtqd3QiLCJ4NXQiOiJHWXVWWDFuWEZmRkt1YmNicXNpakREaVN6aVEifQ.eyJuYmYiOjE2MzQyMjgzMDQsImV4cCI6MTYzNDI0NjMwNCwiaXNzIjoibnVsbCIsImF1ZCI6IklkZW50aXR5U2VydmVyQXBpIiwiY2xpZW50X2lkIjoicm9ib3RlbF93ZWIiLCJzdWIiOiJjZTY5OTJmMi0zZGE0LTRmYjctODc2ZS1hNDA4YzRmMDIwNmYiLCJhdXRoX3RpbWUiOjE2MzQyMjgzMDQsImlkcCI6ImxvY2FsIiwic2NvcGUiOlsib3BlbmlkIiwicHJvZmlsZSIsIklkZW50aXR5U2VydmVyQXBpIl0sImFtciI6WyJwd2QiXX0.M3g0pctGx0_GBv8K6xc6aleYB8xT751lXJ63g2dDaf5_-ufTaz1H_qXpb40rAyTK0eHtRmk5eCO-TUR4NH3gJTjT98iDDmkqCUQmgb0m31DAgJbKPzxdm1q6w1YkTKTDrOgFKHGuTyLGy_Z5JJ3cX3E3tPvzNeapQRQ8sZsSKTzs4f7JCnGjgV7Z3gcqxizVb2xkccqiwlyhxXrXaLjpc8WZN4YSNl3kvUc9IUSdSBTHiXnPMxNcO_3tK1iQPs5SUKDhsXr24X_WU5s_jQhR8d4Is_VbfcsXwC5tdoa8iU_VjIxxDKbsFW6wG5fEPYx9wmGgYu-WENxDORQd4LbGZw">
                <input type="file" class="form-control"  name="image" value="robotel_web">
                
            </div>

        


        <div style="text-align: right;">
        <br /><br /><br />
        <button type="submit" class="btn btn-primary mr-2">บันทึก</button>
        <button class="btn btn-light">ยกเลิก</button>
        </div>

      </form>

     
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){



});
</script>
