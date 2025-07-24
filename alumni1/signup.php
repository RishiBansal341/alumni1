

<?php 
include 'admin/db_connect.php'; 
?>
<?php include 'chatbot.php'; ?>
<style>
    .masthead{
        min-height: 23vh !important;
        height: 23vh !important;
    }
    .masthead:before{
        min-height: 23vh !important;
        height: 23vh !important;
    }
    img#cimg{
        max-height: 10vh;
        max-width: 6vw;
    }
</style>

<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class="text-white">Create Account</h3>
                <hr class="divider my-4" />
                <div class="col-md-12 mb-2 justify-content-center"></div>                        
            </div>
        </div>
    </div>
</header>

<div class="container mt-3 pt-2">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <form action="" id="create_account">
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="" class="control-label">Last Name</label>
                                    <input type="text" class="form-control" name="lastname" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label">First Name</label>
                                    <input type="text" class="form-control" name="firstname" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label">Middle Name</label>
                                    <input type="text" class="form-control" name="middlename">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="" class="control-label">Gender</label>
                                    <select class="custom-select" name="gender" required>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label">Batch</label>
                                    <input type="text" class="form-control datepickerY" name="batch" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label">Course Graduated</label>
                                    <select class="custom-select select2" name="course_id" required>
                                        <option></option>
                                        <?php 
                                        $course = $conn->query("SELECT * FROM courses order by course asc");
                                        while($row=$course->fetch_assoc()):
                                        ?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['course'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-5">
                                    <label for="" class="control-label">Currently Connected To</label>
                                    <textarea name="connected_to" id="" cols="30" rows="3" class="form-control"></textarea>
                                </div>
                                <div class="col-md-5">
                                    <label for="" class="control-label">Image</label>
                                    <input type="file" class="form-control" name="img" onchange="displayImg(this)">
                                    <img src="" alt="" id="cimg">
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="" class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required oninput="showSendOtpButton()">
                                </div>
                                <div class="col-md-4">
                                    <!-- Send OTP button -->
                                    <button id="otpwalabutton" type="button" class="btn btn-info mt-4" onclick="send_otp()" style="display: none;">Send OTP</button>
                                </div>
                            </div>
                            
                            <!-- OTP Section -->
                            <div class="row otp_section" style="display: none;">
                                <div class="col-md-4">
                                    <label for="" class="control-label">Enter OTP</label>
                                    <input type="text" id="otp" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <button id="otpSubmitButton" type="button" class="btn btn-success mt-4" onclick="submit_otp()">Submit OTP</button>
                                </div>
                                <div class="col-md-4">
                                    <p id="otp_error" style="color: red;"></p>
                                </div>
                            </div>

                            <!-- Password Section (Initially Hidden) -->
                            <div class="row password_section" style="display: none;">
                                <div class="col-md-4">
                                    <label for="" class="control-label">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div id="msg"></div>
                            <hr class="divider">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-primary" id="createAccountButton" disabled>Create Account</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Initialize the date picker to only select years
    $('.datepickerY').datepicker({
        format: " yyyy", 
        viewMode: "years", 
        minViewMode: "years"
    });

    // Show 'Send OTP' button when email is entered
    function showSendOtpButton() {
        var email = document.getElementById('email').value;
        if (email.trim() !== '') {
            document.getElementById('otpwalabutton').style.display = 'block';
        } else {
            document.getElementById('otpwalabutton').style.display = 'none';
        }
    }

    // AJAX call to send OTP
    function send_otp() {
        var email = jQuery('#email').val();
        jQuery.ajax({
            url: 'send_otp.php',
            type: 'post',
            data: { email: email },
            success: function(result) {
                var lines = result.split('\n');
                var lastLine = lines[lines.length - 1].trim();

                if (lastLine === 'yes') {
                    jQuery('.otp_section').show();
                    jQuery('#otpwalabutton').hide();
                } else {
                    jQuery('#otp_error').html('Failed to send OTP. Please try again.');
                }
            },
            error: function(xhr, status, error) {
                jQuery('#otp_error').html('An error occurred. Please try again.');
            }
        });
    }

    // AJAX call to verify OTP
    function submit_otp() {
        var otp = jQuery('#otp').val();
        jQuery.ajax({
            url: 'check_otp.php',
            type: 'post',
            data: { otp: otp },
            success: function(result) {
                if (result === 'yes') {
                    jQuery('#otp_error').html(''); // Clear error message
                    jQuery('.password_section').show(); // Show password section
                    document.getElementById('createAccountButton').disabled = false; // Enable Create Account button
                } else {
                    jQuery('#otp_error').html('Invalid OTP. Please try again.');
                }
            },
            error: function(xhr, status, error) {
                jQuery('#otp_error').html('An error occurred while verifying the OTP. Please try again.');
            }
        });
    }

    function displayImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#cimg').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#create_account').submit(function(e){
        e.preventDefault();
        start_load();
        $.ajax({
            url: 'admin/ajax.php?action=signup',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp){
                if(resp == 1){
                    location.replace('index.php');
                } else {
                    $('#msg').html('<div class="alert alert-danger">email already exist.</div>');
                    end_load();
                }
            }
        });
    });
</script>
