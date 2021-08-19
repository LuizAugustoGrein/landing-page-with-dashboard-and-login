<?php 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class Email{

        private $mailer;

        public function __construct($host,$username,$senha,$name){

            $this->mailer = new PHPMailer;
            try {   
                //Server settings
                $this->mailer->isSMTP();                    //Send using SMTP
                $this->mailer->Host       = $host;          //Set the SMTP server to send through
                $this->mailer->SMTPAuth   = true;           //Enable SMTP authentication
                $this->mailer->Username   = $username;      //SMTP username
                $this->mailer->Password   = $senha;         //SMTP password
                $this->mailer->SMTPSecure = 'ssl';          //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $this->mailer->Port       = 465;            //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                //$this->mailer->SMTPDebug  = 5;

                $this->mailer->setFrom($username, $name);
                $this->mailer->isHTML(true);                        //Set email format to HTML
                $this->mailer->CharSet = 'UTF-8';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$e->ErrorInfo}";
            }
        }

        public function addAdress($email,$nome){
            $this->mailer->addAddress($email,$nome);
        }

        public function formatarEmail($info){
            $this->mailer->Subject = $info['assunto'];
            $this->mailer->Body    = $info['corpo'];
            $this->mailer->AltBody = strip_tags($info['corpo']);
        }

        public function enviarEmail(){
            if($this->mailer->send()){
                return true;
            }else{
                return false;
            }
        }
    }

?>