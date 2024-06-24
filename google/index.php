<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php
  require_once 'vendor/autoload.php';

  // init configuration
  $clientID = '544553546635-plillchujbkoikrn7s71qipddbb6j6sh.apps.googleusercontent.com';
  $clientSecret = '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';
  $redirectUri = 'http://localhost/shivam/login/google/';

  // create Client Request to access Google API
  $client = new Google_Client();
  $client->setClientId($clientID);
  $client->setClientSecret($clientSecret);
  $client->setRedirectUri($redirectUri);
  $client->addScope("email");
  $client->addScope("profile");

  // authenticate code from Google OAuth Flow
  if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);
    
    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email =  $google_account_info->email;
    $name =  $google_account_info->name;

    // now you can use this profile info to create account in your website and make user logged in.
  } else {

  ?>
    <div class="wrapper">
      <a href="<?= $client->createAuthUrl() ?>" class="button button--google">Login With Google</a>
    </div>
  <?php } ?>
</body>

</html>

<!-- 

google_account_info data 

Google\Service\Oauth2\Userinfo Object ( [internal_gapi_mappings:protected] => 
Array ( [familyName] => 
family_name [givenName] => given_name
 [verifiedEmail] => verified_email )
  [modelData:protected] => Array ( 
    [verified_email] => 1 
    [given_name] => Shivam 
    [family_name] => Mishra ) [processed:protected] => Array ( ) 
    \[email] => shivam.edunext95@gmail.com
     [familyName] => Mishra 
     [gender] => 
     [givenName] => Shivam 
     [hd] => [id] => 108268551223977871195 
     [link] => [locale] => 
     [name] => Shivam Mishra 
     [picture] => https://lh3.googleusercontent.com/a/ACg8ocKlH1JHNAm0HXAhUEZrN3Wg1kLP2GWC1Jr_7uwzEUUXTw82uE0=s96-c [verifiedEmail] => 1 )
     108268551223977871195 
     
-->