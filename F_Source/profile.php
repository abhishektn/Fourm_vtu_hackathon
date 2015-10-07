<html>
  <head>
    <title>sample app</title>
    <script type='text/javascript' src='https://api.stackexchange.com/js/2.0/all.js'></script>
    <script type='text/javascript'>


      SE.init({
        clientId: 5721,
        key: '*8ljmqTT0PvLlFKAxet03g((',
        channelUrl: 'http://the-one.in',
        redirect_uri:'http://the-one.in/source/index.php',
        complete: function (data) {
            alert("completed!")
        }

      });

      function authenticate()
      {
        SE.authenticate({
          success: function(data) {
                      alert('User Authorized with account id = ' + data.networkUsers[0].account_id + ', got access token = ' + data.accessToken);
                      AT=data.accessToken;
                  },
          error: function(data) {
                      alert('An error occurred:\n' + data.errorName + '\n' + data.errorMessage);
                  },
          redirect_uri:'http://the-one.in/source/index.php',
          networkUsers: true
        });
      }

      
      
    </script>
  </head>

  <body>
<script>

function getUser()
      {

         var urlString = "http://api.stackexchange.com/2.2/me?"

         HTTP.call (
    "GET", 
    urlString, 
    {params:{site:"stackoverflow", key:"i1uC8pTxO4IniPE6YvhwWQ((",access_token=AT}}, 
    function (error,result) {
        console.log (result.data);
    }
);
      }

</script>
    <input type="button" onclick="authenticate()" value="login with stackexchange"></input>
    <input type="button" onclick="getUser()" value=get User Info></input>

  </body>
</html>
