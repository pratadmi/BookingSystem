<?php
require __DIR__.'/repository/Repository.php';

//require dirname(__DIR__).'/backend/viewmodel/Day.php';
//require dirname(__DIR__).'/backend/viewmodel/Service.php';
require dirname(__DIR__).'/backend/logic/Authorize.php';
require dirname(__DIR__).'/backend/logic/Calendar.php';
require dirname(__DIR__).'/backend/logic/Mail.php';
//require dirname(__DIR__).'/backend/repository/Repository.php';

//$rep = new Repository();
//print_r($rep);

//$date = date('Y-m-d');
//$reservations1 = $rep->getReservationsForDay($date, 1);
//print_r($reservations1);

//require dirname(__DIR__).'/backend/view/Json.php';

          

// date_default_timezone_set('Europe/Prague');


// $data_calendar = array('id' => '100110',
//            'summary' => 'summary',
//            'description' => 'description',
//            'start_datetime' => date('c', strtotime('2018-07-16' . ' ' . '03:00')),
//            'end_datetime' => date('c', strtotime('2018-07-16' . ' ' . '04:00')));


//$games = $rep->getServices();
//echo var_dump($games);


//$google_id = (string)$internalInfo->google_id;

//$json = new Json();
//$google_client = new Authorize($google_id);

//echo var_dump($google_client->client);
          //$data_mail['game_name'] = $game_name;
          //$data_mail['lang'] = $lang;
          //$data_mail['players'] = $reservation->people;
          //$data_mail['date_mail'] = date('d.m.Y', strtotime($reservation->date));
          //$data_mail['time_mail'] = $time;
          //$data_mail['voucher_code'] = $voucher;


  $rawEmails = "vaclavik@mf.cz
schleiderova@mf.cz";

    

$data_mail['body'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html style="width:100%;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;">
 <head> 
  <meta charset="UTF-8"> 
  <meta content="width=device-width, initial-scale=1" name="viewport"> 
  <meta name="x-apple-disable-message-reformatting"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta content="telephone=no" name="format-detection"> 
  <title>TorchVR Challenge</title> 
  <!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]--> 
  <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> 
  <style type="text/css">
@media only screen and (max-width:600px) {p, ul li, ol li, a { font-size:14px!important; line-height:150%!important } h1 { font-size:16px!important; text-align:center; line-height:120%!important } h2 { font-size:14px!important; text-align:center; line-height:120%!important } h3 { font-size:14px!important; text-align:center; line-height:120%!important } h1 a { font-size:16px!important } h2 a { font-size:14px!important } h3 a { font-size:14px!important } .es-menu td a { font-size:16px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:14px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:14px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:inline-block!important } a.es-button { font-size:18px!important; display:inline-block!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } .es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } .es-desk-menu-hidden { display:table-cell!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } }
#outlook a {
  padding:0;
}
.ExternalClass {
  width:100%;
}
.ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
  line-height:100%;
}
.es-button {
  mso-style-priority:100!important;
  text-decoration:none!important;
}
a[x-apple-data-detectors] {
  color:inherit!important;
  text-decoration:none!important;
  font-size:inherit!important;
  font-family:inherit!important;
  font-weight:inherit!important;
  line-height:inherit!important;
}
.es-desk-hidden {
  display:none;
  float:left;
  overflow:hidden;
  width:0;
  max-height:0;
  line-height:0;
  mso-hide:all;
}
</style> 
 </head> 
 <body style="width:100%;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;"> 
  <div class="es-wrapper-color" style="background-color:#FEFEFE;"> 
   <!--[if gte mso 9]>
      <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
        <v:fill type="tile" color="#fefefe"></v:fill>
      </v:background>
    <![endif]--> 
   <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;"> 
     <tr style="border-collapse:collapse;"> 
      <td valign="top" style="padding:0;Margin:0;"> 
       <table cellpadding="0" cellspacing="0" class="es-header" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;"> 
         <tr style="border-collapse:collapse;"> 
          <td align="center" style="padding:0;Margin:0;"> 
           <table bgcolor="#ffffff" class="es-header-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;border-left:3px solid #F3EEDE;border-right:3px solid #F3EEDE;"> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="padding:0;Margin:0;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="596" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;"> <img class="adapt-img" src="https://kcyfl.stripocdn.email/content/guids/CABINET_d2ced026ce7e3c263e54f8545410aca1/images/95831557491724112.jpg" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="596"></td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
           </table> </td> 
         </tr> 
       </table> 
       <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
         <tr style="border-collapse:collapse;"> 
          <td align="center" style="padding:0;Margin:0;"> 
           <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;border-left:3px solid #F3EEDE;border-right:3px solid #F3EEDE;"> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-bottom:15px;padding-left:15px;padding-right:15px;padding-top:25px;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="566" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#333333;"><strong></strong><strong></strong><strong>Pro každého</strong></p> </td> 
                     </tr> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#333333;">&nbsp;Snad všechny typy hráčů již vyzkoušely naše hry. Rodiny, přátelé, spolupracovníci, páry, dámské jízdy, lidé tělesně handicapovaní, mladí i staří - ti všichni hráli a úspěšně dokončili své mise.</p> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td class="esdev-adapt-off" align="left" style="Margin:0;padding-bottom:10px;padding-top:15px;padding-left:15px;padding-right:15px;"> 
               <table width="566" cellpadding="0" cellspacing="0" class="esdev-mso-table" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td class="esdev-mso-td" valign="top" esdev-width-px="285" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td width="275" align="left" style="padding:0;Margin:0;"> 
                       <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                         <tr style="border-collapse:collapse;"> 
                          <td align="center" style="padding:0;Margin:0;"> <img class="adapt-img" src="https://kcyfl.stripocdn.email/content/guids/CABINET_d2ced026ce7e3c263e54f8545410aca1/images/32281555941762039.jpg" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="275"></td> 
                         </tr> 
                       </table> </td> 
                      <td width="10" style="padding:0;Margin:0;"></td> 
                     </tr> 
                   </table></td> 
                  <td class="esdev-mso-td" valign="top" esdev-width-px="281" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" class="es-right" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td width="281" align="left" style="padding:0;Margin:0;"> 
                       <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                         <tr style="border-collapse:collapse;"> 
                          <td align="center" style="padding:0;Margin:0;"> <img class="adapt-img" src="https://kcyfl.stripocdn.email/content/guids/CABINET_d2ced026ce7e3c263e54f8545410aca1/images/57531555941750952.jpg" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="281"></td> 
                         </tr> 
                       </table> </td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td class="esdev-adapt-off" align="left" style="Margin:0;padding-top:10px;padding-bottom:15px;padding-left:15px;padding-right:15px;"> 
               <table width="566" cellpadding="0" cellspacing="0" class="esdev-mso-table" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td class="esdev-mso-td" valign="top" esdev-width-px="285" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td width="275" align="left" style="padding:0;Margin:0;"> 
                       <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                         <tr style="border-collapse:collapse;"> 
                          <td align="center" style="padding:0;Margin:0;"> <img class="adapt-img" src="https://kcyfl.stripocdn.email/content/guids/CABINET_d2ced026ce7e3c263e54f8545410aca1/images/11681557418995004.jpg" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="275"></td> 
                         </tr> 
                       </table> </td> 
                      <td width="10" style="padding:0;Margin:0;"></td> 
                     </tr> 
                   </table></td> 
                  <td class="esdev-mso-td" valign="top" esdev-width-px="281" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" class="es-right" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td width="281" align="left" style="padding:0;Margin:0;"> 
                       <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                         <tr style="border-collapse:collapse;"> 
                          <td align="center" style="padding:0;Margin:0;"> <img class="adapt-img" src="https://kcyfl.stripocdn.email/content/guids/CABINET_d2ced026ce7e3c263e54f8545410aca1/images/28951557419007439.jpg" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="281"></td> 
                         </tr> 
                       </table> </td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-left:10px;padding-right:10px;padding-top:15px;padding-bottom:15px;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="574" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#333333;">Torch VR přináší  <br>hrdinské kooperativní dobrodružství pro více hráčů, <br>které nemá zvláštní cílovou skupinu a hrát tak může opravdu každý! <br>Dobrodružství, při kterém hráči pocítí úžas, naplnění a soudržnost jako nikde jinde.
                      </p> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="596" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;"> 
                       <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                         <tr style="border-collapse:collapse;"> 
                          <td style="padding:0;Margin:0px;border-bottom:3px solid #F3EEDE;background:none;height:1px;width:100%;margin:0px;"></td> 
                         </tr> 
                       </table> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-top:15px;padding-bottom:15px;padding-left:15px;padding-right:15px;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="566" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;"> <h1 style="Margin:0;line-height:30px;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;font-size:20px;font-style:normal;font-weight:bold;color:#333333;">Jak jinak ještě více prohloubit tento zážitek, než uspořádáním přátelské soutěže?<br></h1> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="padding:0;Margin:0;padding-bottom:15px;padding-left:15px;padding-right:15px;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="566" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;"> <h2 style="Margin:0;line-height:22px;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;font-size:18px;font-style:normal;font-weight:bold;color:#333333;">Z tohoto důvodu jsme se rozhodli spustit Virtuální výzvu, první týmovou soutěž ve virtuální realitě svého druhu.</h2> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="596" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;"> 
                       <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                         <tr style="border-collapse:collapse;"> 
                          <td style="padding:0;Margin:0px;border-bottom:3px solid #F3EEDE;background:none;height:1px;width:100%;margin:0px;"></td> 
                         </tr> 
                       </table> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-top:15px;padding-bottom:15px;padding-left:15px;padding-right:15px;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="566" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;"> <img src="https://kcyfl.stripocdn.email/content/guids/CABINET_d2ced026ce7e3c263e54f8545410aca1/images/88751555941789757.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="200"></td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-top:15px;padding-bottom:15px;padding-left:15px;padding-right:15px;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="566" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#333333;">Soutěž čtyřčlenných týmů, kde budou hráči čelit nástrahám,<br>které by byly pro skutečný život až příliš nebezpečné!<br></p> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="padding:0;Margin:0;padding-top:15px;padding-left:15px;padding-right:15px;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="564" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#333333;">Hráči budou mít možnost se seznámit s herním formátem  <br>
                        prostřednictvím zahřívacího kola ve hře <br>
                        
                        <b>Escape The Lost Pyramid, </b><br>
                        únikové hře ze světa Assassins Creed Origins.</p> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-top:15px;padding-bottom:15px;padding-left:15px;padding-right:15px;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="566" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;"> <a target="_blank" href="https://www.youtube.com/watch?v=lin61fG1wq4" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;font-size:16px;text-decoration:underline;color:#2CB543;"> <img class="adapt-img" src="https://kcyfl.stripocdn.email/content/guids/videoImgGuid/images/42331555941970021.png" alt="Ubisoft Escape Games | Escape The Lost Pyramid - Trailer" width="566" title="Ubisoft Escape Games | Escape The Lost Pyramid - Trailer" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;"> </a> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-top:15px;padding-bottom:15px;padding-left:15px;padding-right:15px;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="566" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#333333;">V samotné soutěži Virtuální výzva  <br>
                        soutěžící změří své síly ve hře <br>
                       <b> Beyond Medusa’s Gate</b><br>
                       únikové hře odehrávající se v prostředí Assassins Creed Odissey.
                     </p> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-top:15px;padding-bottom:15px;padding-left:15px;padding-right:15px;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="566" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;"> <img class="adapt-img" src="https://kcyfl.stripocdn.email/content/guids/CABINET_d2ced026ce7e3c263e54f8545410aca1/images/46681555942046508.jpg" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="566"></td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-top:15px;padding-bottom:15px;padding-left:15px;padding-right:15px;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="566" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#333333;">
                        <b>Ceny a detaily soutěže Virtuální Výzva budou oznámeny v průběhu zahřívacího kola.</b>
                      </p> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-top:15px;padding-bottom:15px;padding-left:15px;padding-right:15px;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="566" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-top:15px;padding-bottom:15px;padding-left:15px;padding-right:15px;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="566" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#333333;">Rádi bychom vás požádali, abyste zvážili sponzorování této akce a stali se tak součástí budoucnosti zábavního průmyslu.<br><br>Marketing již probíhá v souvislosti se zahřívacím kolem, které se spustí dne 1. června a potrvá až do finále soutěže<br>
                      
                    </p> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-top:15px;padding-bottom:15px;padding-left:15px;padding-right:15px;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="566" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:24px;color:#333333;">Soutěž Virtuální Výva oficiálně začíná 1. srpna a potrvá až do 15. prosince, kdy se uskuteční finále.</p> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
             <tr class="es-mobile-hidden" style="border-collapse:collapse;"> 
              <td align="left" style="Margin:0;padding-top:15px;padding-left:15px;padding-right:15px;padding-bottom:20px;"> 
               <!--[if mso]><table width="564" cellpadding="0" cellspacing="0"><tr><td width="200" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="200" class="es-m-p20b" align="left" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="right" style="padding:0;Margin:0;"> <a target="_blank" href="https://www.tripadvisor.cz/Attraction_Review-g274707-d10681923-Reviews-Torch_VR_Virtual_Reality_Escape_Room_Games-Prague_Bohemia.html" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;font-size:16px;text-decoration:underline;color:#2CB543;"> <img src="https://kcyfl.stripocdn.email/content/guids/CABINET_d2ced026ce7e3c263e54f8545410aca1/images/99271557420160306.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" height="83"> </a> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> 
               <!--[if mso]></td><td width="40"></td><td width="324" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-right" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="324" align="left" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="left" style="padding:0;Margin:0;padding-top:5px;"> <a target="_blank" href="https://www.facebook.com/torchvrcz/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;font-size:16px;text-decoration:underline;color:#2CB543;"> <img src="https://kcyfl.stripocdn.email/content/guids/CABINET_d2ced026ce7e3c263e54f8545410aca1/images/27681557424831565.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" height="84"> </a> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> 
               <!--[if mso]></td></tr></table><![endif]--></td> 
             </tr> 
             <!--[if !mso]><!-- --> 
             <tr class="es-desk-hidden" style="display:none;float:left;overflow:hidden;width:0;max-height:0;line-height:0;mso-hide:all;border-collapse:collapse;"> 
              <td class="esdev-adapt-off" align="left" style="Margin:0;padding-top:15px;padding-left:15px;padding-right:15px;padding-bottom:20px;"> 
               <table width="564" cellpadding="0" cellspacing="0" class="esdev-mso-table" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td class="esdev-mso-td" valign="top" esdev-width-px="283" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td width="278" align="left" style="padding:0;Margin:0;"> 
                       <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                         <tr style="border-collapse:collapse;"> 
                          <td align="center" style="padding:0;Margin:0;"> <a target="_blank" href="https://www.tripadvisor.cz/Attraction_Review-g274707-d10681923-Reviews-Torch_VR_Virtual_Reality_Escape_Room_Games-Prague_Bohemia.html" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;font-size:16px;text-decoration:underline;color:#2CB543;"> <img src="https://kcyfl.stripocdn.email/content/guids/CABINET_d2ced026ce7e3c263e54f8545410aca1/images/99271557420160306.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" height="48"> </a> </td> 
                         </tr> 
                       </table> </td> 
                      <td width="5" style="padding:0;Margin:0;"></td> 
                     </tr> 
                   </table></td> 
                  <td class="esdev-mso-td" valign="top" esdev-width-px="281" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" class="es-right" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td width="281" align="left" style="padding:0;Margin:0;"> 
                       <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                         <tr style="border-collapse:collapse;"> 
                          <td align="center" style="padding:0;Margin:0;"> <a target="_blank" href="https://www.facebook.com/torchvrcz/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;font-size:16px;text-decoration:underline;color:#2CB543;"> <img src="https://kcyfl.stripocdn.email/content/guids/CABINET_d2ced026ce7e3c263e54f8545410aca1/images/27681557424831565.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" height="50"> </a> </td> 
                         </tr> 
                       </table> </td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
             <!--<![endif]--> 
           </table> </td> 
         </tr> 
       </table> 
       <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
         <tr style="border-collapse:collapse;"> 
          <td align="center" style="padding:0;Margin:0;"> 
           <table bgcolor="#ffffff" class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;"> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" bgcolor="#151515" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;background-color:#151515;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="560" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" bgcolor="#151515" style="padding:0;Margin:0;padding-bottom:5px;padding-left:20px;padding-right:20px;"> 
                       <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                         <tr style="border-collapse:collapse;"> 
                          <td style="padding:0;Margin:0px;border-bottom:3px solid #30A8C1;background:none;height:1px;width:100%;margin:0px;"></td> 
                         </tr> 
                       </table> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" bgcolor="#151515" style="padding:0;Margin:0;padding-top:10px;padding-left:20px;padding-right:20px;background-color:#151515;"> 
               <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="270" class="es-m-p20b" align="left" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr class="es-mobile-hidden" style="border-collapse:collapse;"> 
                      <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;"> <img src="https://kcyfl.stripocdn.email/content/guids/CABINET_453249e0c4d9fb4ae690ff96ef5f46ea/images/65871555742900382.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="150"></td> 
                     </tr> 
                     <tr class="es-desk-hidden" style="display:none;float:left;overflow:hidden;width:0;max-height:0;line-height:0;mso-hide:all;border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;"> <img src="https://kcyfl.stripocdn.email/content/guids/CABINET_453249e0c4d9fb4ae690ff96ef5f46ea/images/65871555742900382.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="100"></td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> 
               <!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-right" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="270" align="left" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="left" class="es-m-txt-c" style="padding:0;Margin:0;padding-top:10px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:21px;color:#CCCCCC;">Žitná 1691/44, 120 00 Praha 2-Nové Město, Czechia IČO: 05852242</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:21px;color:#CCCCCC;">Write us at&nbsp;&nbsp;<span style="color:#30A8C1;">info@torchvr.cz</span></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;line-height:21px;color:#CCCCCC;">Call us on&nbsp;<span style="color:#30A8C1;">+420 607 044 123</span></p> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> 
               <!--[if mso]></td></tr></table><![endif]--> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td align="left" bgcolor="#151515" style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px;background-color:#151515;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="560" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;"> 
                       <table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                         <tr style="border-collapse:collapse;"> 
                          <td align="center" valign="top" style="padding:0;Margin:0;padding-right:15px;"> <a target="_blank" href="https://https://www.facebook.com/torchvrcz/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;font-size:14px;text-decoration:underline;color:#FFFFFF;"><img title="Facebook" src="https://kcyfl.stripocdn.email/content/assets/img/social-icons/logo-white/facebook-logo-white.png" alt="Fb" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;"></a> </td> 
                          <td align="center" valign="top" style="padding:0;Margin:0;padding-right:15px;"> <a target="_blank" href="https://www.instagram.com/torchvrcz/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;font-size:14px;text-decoration:underline;color:#FFFFFF;"><img title="Instagram" src="https://kcyfl.stripocdn.email/content/assets/img/social-icons/logo-white/instagram-logo-white.png" alt="Inst" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;"></a> </td> 
                          <td align="center" valign="top" style="padding:0;Margin:0;"> <a target="_blank" href="https://https://www.youtube.com/channel/UCybSTZ15FB_i7pkW7hYOBag" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, helvetica neue, arial, verdana, sans-serif;font-size:14px;text-decoration:underline;color:#FFFFFF;"><img title="Youtube" src="https://kcyfl.stripocdn.email/content/assets/img/social-icons/logo-white/youtube-logo-white.png" alt="Yt" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;"></a> </td> 
                         </tr> 
                       </table> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
           </table> </td> 
         </tr> 
       </table> </td> 
     </tr> 
   </table> 
  </div>  
 </body>
</html>';

          
          $data_mail['name'] = "Michael z TorchVR";
          $data_mail['title'] = "TORCH VR + UBISOFT = VR CHALLENGE";
          



$google_id = "info@torchvr.cz";       
$google_client = new Authorize($google_id);




    $str_arr = explode ("\n", $rawEmails);
    foreach ($str_arr as &$client_email) {
      $client_email = rtrim($client_email);
         $client_email = ltrim($client_email);
         echo $client_email."<br>";
         $data_mail['email_client'] = $client_email;
          $data_mail['name_client'] = $client_email;
         $mail = new Mail($google_client->client, $google_id);
    echo $mail->sendMailOnly($data_mail) . " sent to: ".$client_email."<br>";

    }
    

    


/*  foreach ($str_arr as &$client_email) {
        $client_email = rtrim($client_email);
         $client_email = ltrim($client_email);
         $data_mail['email_client'] = $client_email;
          $data_mail['name_client'] = $client_email;
          $mail = new Mail($google_client->client, $google_id);
          echo $mail->sendMailOnly($data_mail) . " sent to: ".$client_email."<br>";

    }  */
    





       
          //from DB


       
//$calendar = new Calendar($google_client->client, $google_id);
// $calendar->addEvent($data_calendar);
//$service = new Google_Service_Calendar($google_client->client);
//$event = $service->events->get('primary', 'f2313d4512');

//$event->setTransparency('opaque');
//$event->setColorId('8');

//$updatedEvent = $service->events->update('primary', $event->getId(), $event);

// Print the updated date.
//echo $updatedEvent->getUpdated() . "<br>";


/*
$data_calendar = array('id' => "22232342352346",
            'summary' => "TEST4",
            'description' => "description",
            'start_datetime' => date('c', strtotime('2018-11-10' . ' ' . '23:00')),
            'end_datetime' => date('c', strtotime('2018-11-10' . ' ' . '23:15')));
$google_client = new Authorize("info@torchvr.cz");
          $calendar = new Calendar($google_client->client, "info@torchvr.cz");
          $calendar->addEvent($data_calendar);**/
//$calendar = new Calendar($google_client->client, $google_id);
//echo var_dump($calendar->service);
//$calendar->addEvent($data_calendar);

//echo "hello";
//require './view/Json.php';
//date_default_timezone_set('Europe/Prague');
//$json = new Json();
//echo $json->city;
//$rep = new Repository();

//echo $rep->getConnection();
//echo 'GOOGLE_APPLICATION_CREDENTIALS='.__DIR__.'/logic/secret/torchvrbk.json';
//echo var_dump($rep->getReservationsForDay('2018-07-14', 'ESCAPE_ROOM'));
//echo var_dump($rep->deleteReservationById(5)); 
//echo var_dump($rep->deleteReservationById(6));
//echo var_dump($rep->deleteReservationById(7));
//echo var_dump($rep->deleteReservationById(8));
//echo var_dump($rep->deleteContactInfoById(3));
//echo "hello";
// $dbhost="c100um.forpsi.com";
// $dbuser="f106443";
// $dbpass="NvSS6EgJ";
// $dbname="f106443";

// $db = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));  
// $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// $stmt = $db->prepare("select * from service");  
// $stmt->execute();
// $service = $stmt->fetchObject();

// echo var_dump($service);


// $dbh = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
// if($dbh->connect_errno){
//  echo "error: " . $dbh->connect_error;
//  exit();
// }
// else {
//  echo "success: " . $dbh->server_info;
// }



//echo $rep->getReservationToDelete('2018-07-04 13:27:38', 'developer.stepanov@gmail.com')->reservationid;
//$rep->insertReservation('2018-12-12', '14:00:00', 2, 1000, 'mail', 'Cosmos', 'CZK', '100881', '161651');
/*
    $stmt->bindParam('date', $date);
      $stmt->bindParam('time', $time);
      $stmt->bindParam('people', $people);
      $stmt->bindParam('total_cost', $total_cost);
      $stmt->bindParam('email', $email);
      $stmt->bindParam('game_name', $game_name);
      $stmt->bindParam('langname', $langname);
      $stmt->bindParam('unique_id', $unique_id);
      $stmt->bindParam('voucher', $voucher);
*/

//echo var_dump($json->deleteReservation('1a383886b6'));

//echo $json->deleteReservation('54524405c9');

// $delete_link = 'http://vk.com';

// $body = '';
// $body .= '<h1>Test HTML MESSAGE!</h1>';
// $body .= '<p><a href={delete_link}>Zruseni rezervace</a></p>';

// $vars = array(
//   '{delete_link}' => $delete_link
// );

// echo strtr($body, $vars);

// $date = date('d.m.Y', strtotime('2018-08-21'));

// echo $date;

?>