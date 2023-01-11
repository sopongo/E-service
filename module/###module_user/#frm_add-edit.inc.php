<!-- add/edit form modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลผู้ใช้งาน<i class="fa fa-user-circle-o" aria-hidden="true"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


    <!--FORM 1-->
    <div class="container py-5">  
        <div class="row">  
            <div class="offset-md-2 col-md-8 offset-md-2">  
                <div class="card">  
                    <div class="card-header bg-primary text-white">  
                        <h4 class="card-title text-uppercase">กรอกข้อมูลผู้ใช้งาน</h4>  
                    </div>  
                    <div class="card-body">  
                        <form id="needs-validation" novalidate>  
                            <div class="row">  
                                <div class="col-sm-6 col-md-6 col-xs-12">  
                                    <div class="form-group">  
                                        <label for="firstname">First Name</label>  
                                        <input type="text" id="firstname" placeholder="First Name" class="form-control" aria-describedby="inputGroupPrepend" required />  
                                        <div class="invalid-feedback">  
                                            Please enter first name.  
                                        </div>  
                                    </div>  
                                </div>  
                                <div class="col-sm-6 col-md-6 col-xs-12">  
                                    <div class="form-group">  
                                        <label for="lastname">Last Name</label>  
                                        <input type="text" id="lastname" placeholder="Last Name" class="form-control" aria-describedby="inputGroupPrepend" required />  
                                        <div class="invalid-feedback">  
                                            Please enter last name.  
                                        </div>  
                                    </div>  
                                </div>  
                            </div>  
                            <div class="row">  
                                <div class="col-sm-4 col-md-4 col-xs-12">  
                                    <div class="form-group">  
                                        <label for="Gender">Gender</label>  
                                        <select class="custom-select" required>  
                                            <option value="">Select Gender</option>  
                                            <option value="1">Male</option>  
                                            <option value="2">Female</option>  
                                        </select>  
                                        <div class="invalid-feedback">Please choose gender</div>  
                                    </div>  
                                </div>  
                                <div class="col-sm-4 col-md-4 col-xs-12">  
                                    <div class="form-group">  
                                        <label for="email">Email address</label>  
                                        <input type="email" class="form-control" id="email" placeholder="email address" aria-describedby="inputGroupPrepend" required>  
                                        <div class="invalid-feedback">  
                                            Please provide a valid email.  
                                        </div>  
                                    </div>  
                                </div>  
                                <div class="col-sm-4 col-md-4 col-xs-12">  
                                    <div class="form-group">  
                                        <label for="phonenumber">Mobile Number</label>  
                                        <input type="tel" pattern="^\d{10}$" class="form-control" id="phonenumber" placeholder="Mobile Number" aria-describedby="inputGroupPrepend" required>  
                                        <div class="invalid-feedback">  
                                            Please enter 10 digit mobile number.  
                                        </div>  
                                    </div>  
                                </div>  
                            </div>  
                            <div class="row">  
                                <div class="col-sm-12 col-md-12 col-xs-12">  
                                    <div class="form-group">  
                                        <label>Mandatory Skills</label>                                          
                                    </div>  
                                    <div class="form-check-inline">  
                                        <div class="custom-control custom-radio ">  
                                            <input type="radio" class="custom-control-input" id="html" aria-describedby="inputGroupPrepend" name="radio-html" required>  
                                            <label class="custom-control-label" for="html">HTML 5</label>  
                                            <div class="invalid-feedback">Choose skill</div>  
                                        </div>                                          
                                    </div>  
                                    <div class="form-check-inline">  
                                        <div class="custom-control custom-radio ">  
                                            <input type="radio" class="custom-control-input" id="javascript" aria-describedby="inputGroupPrepend" name="radio-javascript" required>  
                                            <label class="custom-control-label" for="javascript">JavaScript</label>  
                                            <div class="invalid-feedback">Choose skill</div>  
                                        </div>  
                                    </div>  
                                    <div class="form-check-inline">  
                                        <div class="custom-control custom-radio ">  
                                            <input type="radio" class="custom-control-input" id="csharp" aria-describedby="inputGroupPrepend" name="radio-csharp" required>  
                                            <label class="custom-control-label" for="csharp">C# Programming</label>  
                                            <div class="invalid-feedback">Choose skill</div>  
                                        </div>  
                                    </div>  
                                    <div class="form-check-inline">  
                                        <div class="custom-control custom-radio">  
                                            <input type="radio" class="custom-control-input" id="aspdotnet" aria-describedby="inputGroupPrepend" name="radio-aspdotnet" required>  
                                            <label class="custom-control-label" for="aspdotnet">ASP.NET</label>  
                                            <div class="invalid-feedback">Choose skill</div>  
                                        </div>  
                                    </div>  
                                    <div class="form-check-inline">  
                                        <div class="custom-control custom-radio">  
                                            <input type="radio" class="custom-control-input" id="MVC" name="radio-MVC" required>  
                                            <label class="custom-control-label" for="MVC">ASP.NET MVC</label>  
                                            <div class="invalid-feedback">Choose skill</div>  
                                        </div>  
                                    </div>                                    
                                </div>  
                            </div>  
                            <div class="row">  
                                <div class="col-sm-12 col-md-12 col-xs-12">  
                                    <div class="form-group">  
                                        <label>Profile Picture</label>  
                                        <div class="custom-file">  
                                            <input type="file" class="custom-file-input" id="validatedCustomFile" required>  
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>  
                                            <div class="invalid-feedback">Choose file for upload</div>  
                                        </div>  
                                    </div>                                  
                                </div>  
                            </div>  
                            <div class="row">  
                                <div class="col-sm-12 col-md-12 col-xs-12">  
                                    <div class="form-group">  
                                        <label for="address">Address</label>  
                                        <textarea class="form-control" rows="3" id="address" aria-describedby="inputGroupPrepend" required></textarea>  
                                        <div class="invalid-feedback">please enter address</div>  
                                    </div>  
                                </div>  
                            </div>  
                            <div class="row">  
                                <div class="col-sm-12 col-md-12 col-xs-12">  
                                    <div class="form-group">  
                                        <div class="form-check">  
                                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>  
                                            <label class="form-check-label" for="invalidCheck">  
                                                Agree to terms and conditions  
                                            </label>  
                                            <div class="invalid-feedback">  
                                                You must agree before submitting.  
                                            </div>  
                                        </div>  
                                    </div>  
                                </div>  
                            </div>  
                            <div class="row">  
                                <div class="col-sm-12 col-md-12 col-xs-12">  
                                    <div class="float-right">  
                                        <button class="btn btn-danger rounded-0" type="submit">Cancel</button>  
                                        <button class="btn btn-primary rounded-0" type="submit">Register</button>  
                                    </div>                            
                                </div>  
                            </div>  
                        </form>  
                    </div>  
                </div>  
            </div>  
        </div>  
    </div>  
    <!--FORM 1-->

  

    <!--FORM 2-->
      <form id="addform" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user-circle-o" aria-hidden="true"></i>
              </div>
              <input type="text" class="form-control" id="username" name="username" autocomplete="off" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Email:</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o"
                    aria-hidden="true"></i></span>
              </div>
              <input type="email" class="form-control" id="email" name="email" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Phone:</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"
                    aria-hidden="true"></i></span>
              </div>
              <input type="phone" class="form-control" id="phone" name="phone" required="required" maxLength="10"
                minLength="10">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Photo:</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01"><i class="fa fa-picture-o"
                    aria-hidden="true"></i></span>
              </div>
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="photo" id="userphoto">
                <label class="custom-file-label" for="userphoto">Choose file</label>
              </div>
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" id="addButton">Submit</button>
          <input type="hidden" name="action" value="addUser">
          <input type="hidden" name="userid" id="userid" value="">
        </div>
      </form>
        </div>
    <!--end FORM 2-->

  </div>
</div>
<!-- add/edit form modal end -->
