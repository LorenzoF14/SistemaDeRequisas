<div class="main-background"></div>

<section class="fullCenter" style="position: relative; z-index: 1; color: white;">
  <form class="grid" method="post" action="index.php?page=sec_login{{if redirto}}&redirto={{redirto}}{{endif redirto}}">
    <section class="row col-12 col-m-8 offset-m-2 col-xl-6 offset-xl-3">
      <h1 class="col-12 center">Log In</h1>
    </section>
    <section class="py-5 row col-12 col-m-8 offset-m-2 col-xl-6 offset-xl-3">
      <div class="row">
        <label class="col-12 col-m-4 flex align-center" for="txtEmail">📧 Email Address</label>
        <div class="col-12 col-m-8">
          <input class="width-full" type="email" id="txtEmail" name="txtEmail" value="{{txtEmail}}" />
        </div>
        {{if errorEmail}}
        <div class="error col-12 py-2 col-m-8 offset-m-4">{{errorEmail}}</div>
        {{endif errorEmail}}
      </div>
      <div class="row">
        <label class="col-12 col-m-4 flex align-center" for="txtPswd">🔒 Password</label>
        <div class="col-12 col-m-8">
          <input class="width-full" type="password" id="txtPswd" name="txtPswd" value="{{txtPswd}}" />
        </div>
        {{if errorPswd}}
        <div class="error col-12 py-2 col-m-8 offset-m-4">{{errorPswd}}</div>
        {{endif errorPswd}}
      </div>
      {{if generalError}}
      <div class="row">
        {{generalError}}
      </div>
      {{endif generalError}}
      <div class="row right flex-end px-4">
        <button class="primary" id="btnLogin" type="submit">Log In</button>
      </div>
    </section>
  </form>
</section>