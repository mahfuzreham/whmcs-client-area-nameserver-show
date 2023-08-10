<?php

///////////////////////// Me@MahfuzReham.Com /////////////////////////
//                                                                    //
//                                                                    //
//                MD Mahfuz Reham - www.MahfuzReham.Com              //
//                                                                    //
////////////////////////////////////////////////////////////////////////

use WHMCS\View\Menu\Item as MenuItem;
use Illuminate\Database\Capsule\Manager as Capsule;


add_hook('ClientAreaSecondarySidebar', 1, function (MenuItem $secondarySidebar)
{

$service = Menu::context('service');
$username = "{$service->username}";
$serverid = "{$service->server}";
$domain = "{$service->domain}";
$password = "{$service->password}";
$server = Capsule::table('tblservers')->where('id', '=', $serverid)->pluck('hostname');
$ipaddress = Capsule::table('tblservers')->where('id', '=', $serverid)->pluck('ipaddress');
$name1 = Capsule::table('tblservers')->where('id', '=', $serverid)->pluck('nameserver1');
$name2 = Capsule::table('tblservers')->where('id', '=', $serverid)->pluck('nameserver2');

$password = decrypt($password);

if ($username != '') {

$secondarySidebar->addChild('credentials', array(
'label' => 'Nameservers Information',
'uri' => '#',
'icon' => 'fa-desktop',
));

$credentialPanel = $secondarySidebar->getChild('credentials');
$credentialPanel->moveToBack();

/*IP*/
$credentialPanel->addChild('ipaddress', array(
'label' => $ipaddress,
'order' => 5,
'icon' => 'fa fa-server fa-spin',
));


/*NS1*/
$credentialPanel->addChild('name1', array(
'label' => $name1,
'order' => 6,
'icon' => 'fa fa-server',
));
/*NS2*/
$credentialPanel->addChild('name2', array(
'label' => $name2,
'order' => 7,
'icon' => 'fa fa-server',
));
}
});
