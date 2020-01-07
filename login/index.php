<link rel="stylesheet" type="text/css" href="css/index.css">
<div class="login">
<h4 class="tlogin">Daftra</h4>
<form name="login" action="cek_login.php" method="POST" onSubmit="return validasi(this)">
		
		<div class="login-inside">
			<div class="login-data">
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><div align="center">
                    <table cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="25">Username</td>
                        <td> 
                          <input type="text" name="username"  class="text" /></td>
                      </tr>
                      <tr>
                        <td height="26">Password</td>
                        <td> 
                          <input type="password" class="text" name="password" /></td>
                      </tr>
                      
                      <tr>
                        <td colspan="2"><div align="right">
                          <input name="submit"  class="submit" type="submit" value="LOGIN" />
                        </div></td>
                      </tr>
                    </table>
                  </div></td>
                </tr>
              </table>
			</div>
		</div>
	  </form>

</div>
