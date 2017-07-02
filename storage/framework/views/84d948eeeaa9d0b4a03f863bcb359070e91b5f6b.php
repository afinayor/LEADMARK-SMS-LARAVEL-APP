<?php /*extending the main template*/ ?>




<?php $__env->startSection('content'); ?>

 <!-- LOGIN FORM -->
  <div class="login-page login-area-bg">
   <section class="login-bg">

    <h1 class="login-area-logo">Zenda <i class="icon-pencil"></i></h1>

     <div class="login-section login-area section">
       <div class="container">
         <div class="row">
           <div class="form-box col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0">
              <div class="form-box-inner">

                <h2 class="title text-center">Log in to Zenda</h2>


                <div class="row">


                <div class="form-container col-md-5 col-sm-12 col-xs-12">
               <form class="login-form">
                  <div class="form-group email">
                 <label class="sr-only" for="login-email">Email or username</label>
                <input id="login-email" type="email" class="form-control login-email" placeholder="Email or username">
               </div>
              <div class="form-group password">
             <label class="sr-only" for="login-password">Password</label>
            <input id="login-password" type="password" class="form-control login-password" placeholder="Password">
           <p class="forgot-password"><a href="reset-password.html">Forgot password?</a></p>
          </div>
        <button type="submit" class="btn btn-block login-area-btn">Log in</button>
          <div class="checkbox remember">
       <label>
        <input type="checkbox"> Remember me </label>
          </div>
       <p class="lead">Don't have an account?  <a class="signup-link" href="signup.html">Create at here</a></p>
             </form>
            </div>


     <div class="social-btns col-md-5 col-sm-12 col-xs-12 col-md-offset-1 col-sm-offset-0 col-sm-offset-0">
       <div class="divider"><span>Or</span></div>
         <ul class="list-unstyled social-login">
           <li><button class="facebook-btn btn" type="button"><i class="fa fa-facebook"></i>Log in with Facebook</button></li>
           <li><button class="twitter-btn btn" type="button"><i class="fa fa-twitter"></i>Log in with Twitter</button></li>
           <li><button class="google-btn btn" type="button"><i class="fa fa-google-plus"></i>Log in with Google+</button></li>
           <li><button class="linkedin-btn btn" type="button"><i class="fa fa-linkedin"></i>Log in with Linkedin</button></li>
           <li><button class="pinterest-btn btn" type="button"><i class="fa fa-pinterest"></i>Log in with Pinterest</button></li>
          </ul>
              </div>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
      </section>
     </div>
     <!-- LOGIN FORM END -->



            </div>
        </div>
    </section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>