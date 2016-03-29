---
author: admin
comments: false
layout: page
slug: contact
title: Contact
wordpress_id: 456
categories:
- Misc
---
<script src='https://www.google.com/recaptcha/api.js'></script>

<form action="contact.php" method="post">
<br/>
  <label>Name:<input type='text' name='nome' size='40' /></label><br/>
  <label>Email:<input type='text' name='email' size='40' /></label><br/>
  <label>Subject:<input type='text' name='assunto' size='40' /></label><br/>
  <label>Message:<br/><textarea name='mensagem' rows="5" cols="60" ></textarea></label><br/><br/>
  <div class="g-recaptcha" data-sitekey="6LeTe_8SAAAAAAqg-vxAaB74Hf_0LMPN3tkBb5Zo"></div>
  <br/>
  <input type='submit' value='Send' />
</form>