<?php defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Mailer {
    protected $_ci;
    //protected $email_pengirim = 'emailkaoskubali@gmail.com'; // Isikan dengan email pengirim
    protected $nama_pengirim = 'Sikapuas'; // Isikan dengan nama pengirim
    //protected $password = 'rcwcgesplnxlerva'; // Isikan dengan password email pengirim
    public function __construct(){
        $this->_ci = &get_instance(); // Set variabel _ci dengan Fungsi2-fungsi dari Codeigniter
        require_once(APPPATH.'third_party/phpmailer/Exception.php');
        require_once(APPPATH.'third_party/phpmailer/PHPMailer.php');
        require_once(APPPATH.'third_party/phpmailer/SMTP.php');
    }
    public function send($data){
        $email_pengirim = $data['email_pengirim'];
        $password_app   = $data['password_app'];
        $subjek         = $data['subjek'];
        $email_penerima = $data['email_penerima'];
        $html_template  = $data['content'];
        $Mail = new PHPMailer;
        $Mail->IsSMTP(); // Use SMTP
        $Mail->Host        = 'smtp.gmail.com'; // Sets SMTP server
        // $Mail->SMTPDebug   = 2; // 2 to enable SMTP debug information
        $Mail->SMTPAuth    = TRUE; // enable SMTP authentication
        $Mail->Port        = '587'; // set the SMTP port
        $Mail->Username    = $email_pengirim; // SMTP account username
        $Mail->Password    = $password_app; // SMTP account password
        $Mail->Priority    = 1; // Highest priority - Email priority (1 = High, 3 = Normal, 5 = low)
        $Mail->CharSet     = 'UTF-8';
        $Mail->Encoding    = '8bit';
        $Mail->Subject     = $subjek;
        $Mail->ContentType = 'text/html; charset=utf-8\r\n';
        $Mail->From        = $email_pengirim;
        $Mail->FromName    = 'SMK NEGERI 7 BURU';
        $Mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );
        $Mail->WordWrap    = 900; // RFC 2822 Compliant for Max 998 characters per line

        $Mail->AddAddress($email_penerima); // To:
        $Mail->isHTML( TRUE );
        $Mail->Body    = $html_template;
        $send = $Mail->send();
        if($send){ // Jika Email berhasil dikirim
            $response = array('status'=>'Sukses', 'message'=>'Email berhasil dikirim');
        }else{ // Jika Email Gagal dikirim
            $response = array('status'=>'Gagal', 'message'=>'Email gagal dikirim');
        }
        return $response;
    }
    public function send_with_attachmentlapor($data){
        $mail = new PHPMailer;
        $email_pengirim = $data['email_pengirim'];
        $password_app   = $data['password_app'];
        $attachment     = "public/image/upload/laporan/".$data['attachment'];
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = $email_pengirim; // Email Pengirim
        $mail->Password = $password_app; // Isikan dengan Password email pengirim
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        //$mail->SMTPDebug = 2; // Aktifkan untuk melakukan debugging
        $mail->setFrom($email_pengirim, $this->nama_pengirim);
        $mail->addAddress($data['email_penerima'], '');
        $mail->isHTML(true); // Aktifkan jika isi emailnya berupa html
        $mail->Subject = $data['subjek'];
        $mail->Body = $data['content'];
        $mail->SMPTPOptions = array('ssl' => array(
                'verify_peer' => false,
                'verify_peername' => false,
                'allow_self_signed' => false
        ));
        $mail->addAttachment($attachment);
        //$mail->AddEmbeddedImage('public/image/logosikapuas.png', 'Sikapuas', 'logosikapuas.png'); // Aktifkan jika ingin menampilkan gambar dalam email
        $send = $mail->send();
        if($send){ // Jika Email berhasil dikirim
            $response = array('status'=>'Sukses', 'message'=>'Email berhasil dikirim');
        }else{ // Jika Email Gagal dikirim
            $response = array('status'=>'Gagal', 'message'=>'Email gagal dikirim');
        }
        return $response;
    }

    public function send_with_attachmentsewa($data){
        $mail = new PHPMailer;
        $email_pengirim = $data['email_pengirim'];
        $password_app   = $data['password_app'];
        $attachment     = "public/image/upload/perizinan/".$data['attachment'];
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = $email_pengirim; // Email Pengirim
        $mail->Password = $password_app; // Isikan dengan Password email pengirim
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        //$mail->SMTPDebug = 2; // Aktifkan untuk melakukan debugging
        $mail->setFrom($email_pengirim, $this->nama_pengirim);
        $mail->addAddress($data['email_penerima'], '');
        $mail->isHTML(true); // Aktifkan jika isi emailnya berupa html
        $mail->Subject = $data['subjek'];
        $mail->Body = $data['content'];
        $mail->SMPTPOptions = array('ssl' => array(
                'verify_peer' => false,
                'verify_peername' => false,
                'allow_self_signed' => false
        ));
        $mail->addAttachment($attachment);
        //$mail->AddEmbeddedImage('public/image/logosikapuas.png', 'Sikapuas', 'logosikapuas.png'); // Aktifkan jika ingin menampilkan gambar dalam email
        $send = $mail->send();
        if($send){ // Jika Email berhasil dikirim
            $response = array('status'=>'Sukses', 'message'=>'Email berhasil dikirim');
        }else{ // Jika Email Gagal dikirim
            $response = array('status'=>'Gagal', 'message'=>'Email gagal dikirim');
        }
        return $response;
    }
}