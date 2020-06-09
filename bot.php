<?php

require_once('./line_class.php');
require_once('./unirest-php-master/src/Unirest.php');

$AreaCctv ="""╭「 🎥 AREA CODE CCTV 🎥 」
  Next Gunakan Kode 
  Ketik cctv: [nomor kode di atas]
"""
# LINK UNTUK AMBIL ACCESS TOKEN
# https://developers.line.biz/en/reference/messaging-api/#issue-channel-access-token


# MTz0R9WOuKdtY6U113PjsYADFSa6F2BLUYkNdzB+x6Sm+S9BVbOwrASYpmT7J+cGe2g7zFhqvkzVnyu8QQW51QZyZf2s5O6tYKyabO/A5F4SsOcY0700Fd4Bq52Wf83KijQM7RdgCmCI8qobHVPUno9PbdgDzCFqoOLOYbqAITQ=",

$channelAccessToken = 'MTz0R9WOuKdtY6U113PjsYADFSa6F2BLUYkNdzB+x6Sm+S9BVbOwrASYpmT7J+cGe2g7zFhqvkzVnyu8QQW51QZyZf2s5O6tYKyabO/A5F4SsOcY0700Fd4Bq52Wf83KijQM7RdgCmCI8qobHVPUno9PbdgDzCFqoOLOYbqAITQ='; //sesuaikan 
$channelSecret = '2c24c02e76b62f7f69d939088216f4f8';//sesuaikan

$client = new LINE_BOT_RFU($channelAccessToken, $channelSecret);

$userId 	= $client->parseEvents()[0]['source']['userId'];
$groupId 	= $client->parseEvents()[0]['source']['groupId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp	= $client->parseEvents()[0]['timestamp'];
$type 		= $client->parseEvents()[0]['type'];

$message 	= $client->parseEvents()[0]['message'];
$messageid 	= $client->parseEvents()[0]['message']['id'];

$profil = $client->profil($userId);

$pesan_datang = explode(" ", $message['text']);

$command = $pesan_datang[0];
$options = $pesan_datang[1];
if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}

#-------------------------[FUNCTION TOKEN API]-------------------------#
function IOSIPAD($keyword) {
    $uri = "https://rfutoken.herokuapp.com/iosipad/" . $keyword;
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = "「TYPE IOSIPAD」\n\nQR LOGIN:\n ";
	$result .= $json['qr'];
	$result .= "\n\n「 🀄ʀғᴜ sᴇᴋᴀᴡᴀɴ」";
    return $result;
}

function CHROMEOS($keyword) {
    $uri = "https://rfutoken.herokuapp.com/chromeos/" . $keyword;
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = "「TYPE CHROMEOS」\n\nQR LOGIN:\n ";
	$result .= $json['qr'];
	$result .= "\n\n「 🀄ʀғᴜ sᴇᴋᴀᴡᴀɴ」";
    return $result;
}

function DESKTOPMAC($keyword) {
    $uri = "https://rfutoken.herokuapp.com/desktopmac/" . $keyword;
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = "「TYPE DESKTOPMAC」\n\nQR LOGIN:\n ";
	$result .= $json['qr'];
	$result .= "\n\n「 🀄ʀғᴜ sᴇᴋᴀᴡᴀɴ」";
    return $result;
}

function DESKTOPWIN($keyword) {
    $uri = "https://rfutoken.herokuapp.com/desktopwin/" . $keyword;
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = "「TYPE DESKTOPWIN」\n\nQR LOGIN:\n ";
	$result .= $json['qr'];
	$result .= "\n\n「 🀄ʀғᴜ sᴇᴋᴀᴡᴀɴ」";
    return $result;
}

#-------------------------[FUNCTION JOIN CHAT INTO GROUP]-------------------------#

//show menu, saat join dan command /menu
if ($type == 'join' || $command == 'help') {
    $ret_ = "Thanks For Invite into Group\n\nMau Login Line Bot?";
    $ret_ .= "\nMasih Pakai Kode Verifikasi? (Gak Jaman Goblok)";
    $ret_ .= "\nGw sediain nih Botnya, Ketik Help Untuk Bantuan Atau\nKick gw Kalau lu gak butuh gw (BANGSAT LO)";
    $text = $ret_;
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            )
        )
    );
}

#-------------------------[FUNCTION GET TOKEN & QR CMD TEXT]-------------------------#


if($message['type']=='text') {
	    if ($command == 'iosipad:') {

        $result = IOSIPAD($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}

if($message['type']=='text') {
	    if ($command == 'chromeos:') {

        $result = CHROMEOS($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}

if($message['type']=='text') {
	    if ($command == 'desktopmac:') {

        $result = DESKTOPMAC($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}

if($message['type']=='text') {
	    if ($command == 'desktopwin:') {

        $result = DESKTOPWIN($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}

if (isset($balas)) {
    $result = json_encode($balas);


    file_put_contents('./balasan.json', $result);


    $client->replyMessage($balas);
}
?>
