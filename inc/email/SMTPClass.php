<?php
	/**************************************************************************************************
	#     Copyright (c) 2008 - 2013 Fernando A. Rodríguez para SerInformaticos.es                     #
	#                                                                                                 #
	#     Este programa es software libre: usted puede redistribuirlo y / o modificarlo               #
	#     bajo los t&eacute;rminos de la GNU General Public License publicada por la                  #
	#     la Free Software Foundation, bien de la versi&oacute;n 3 de la Licencia, o de               #
	#     la GPL2, o cualquier versi&oacute;n posterior.                                              #
	#                                                                                                 #
	#     Este programa se distribuye con la esperanza de que sea &uacute;til,                        #
	#     pero SIN NINGUNA GARANTÍA, incluso sin la garant&iacute;a impl&iacute;cita de               #
	#     COMERCIABILIDAD o IDONEIDAD PARA UN PROPÓSITO PARTICULAR. V&eacute;ase el                   #
	#     GNU General Public License para m&aacute;s detalles.                                        #
	#                                                                                                 #
	#     Usted deber&iacute;a haber recibido una copia de la Licencia P&uacute;blica General de GNU  #
	#     junto con este programa. Si no, visite <http://www.gnu.org/licenses/>.                      #
	#                                                                                                 #
	#     Puede descargar la version completa de la GPL3 en este enlace:                              #
	#     	< http://www.serinformaticos.es/index.php?file=kop804.php >                               #
	#                                                                                                 #
	#     Para mas información puede contactarnos :                                                   #
	#                                                                                                 #
	#       Teléfono  (+34) 961 19 60 62                                                              #
	#                                                                                                 #
	#       Email:    info@serinformaticos.es                                                         #
	#                                                                                                 #
	#       MSn:      info@serinformaticos.es                                                         #
	#                                                                                                 #
	#       Twitter:  @SerInformaticos                                                                #
	#                                                                                                 #
	#       Web:      www.SerInformaticos.es                                                          #
	#                                                                                                 #
	**************************************************************************************************/


class SMTPClient{

	function SMTPClient ($SmtpServer, $SmtpPort, $SmtpUser, $SmtpPass, $from, $to, $subject, $body) {

		$this->SmtpServer = $SmtpServer;
		$this->SmtpUser = base64_encode ($SmtpUser);
		$this->SmtpPass = base64_encode ($SmtpPass);
		$this->from = $from;
		$this->to = $to;
		$this->subject = $subject;
		$this->body = $body;

		if ($SmtpPort == ""){
			$this->PortSMTP = 25;
		} else{
			$this->PortSMTP = $SmtpPort;
		}
	}

	function SendMail (){
		if ($SMTPIN = fsockopen ($this->SmtpServer, $this->PortSMTP)){
			//fputs ($SMTPIN, "EHLO ".$HTTP_HOST."\r\n");
			fputs ($SMTPIN, "EHLO smtp.1and1.es \r\n");
			$talk["hello"] = fgets ( $SMTPIN, 1024 );
			fputs($SMTPIN, "auth login\r\n");
			$talk["res"]=fgets($SMTPIN,1024);
			fputs($SMTPIN, $this->SmtpUser."\r\n");
			$talk["user"]=fgets($SMTPIN,1024);
			fputs($SMTPIN, $this->SmtpPass."\r\n");
			$talk["pass"]=fgets($SMTPIN,256);
			fputs ($SMTPIN, "MAIL FROM: <".$this->from.">\r\n");
			$talk["From"] = fgets ( $SMTPIN, 1024 );
			fputs ($SMTPIN, "RCPT TO: <".$this->to.">\r\n");
			$talk["To"] = fgets ($SMTPIN, 1024);
			fputs($SMTPIN, "DATA\r\n");
			$talk["data"]=fgets( $SMTPIN,1024 );
			fputs($SMTPIN, "To: <".$this->to.">\r\nFrom: <".$this->from.">\r\nSubject:".$this->subject."\r\n\r\n\r\n".$this->body."\r\n.\r\n");
			$talk["send"]=fgets($SMTPIN,256);
			//CLOSE CONNECTION AND EXIT ...
			fputs ($SMTPIN, "QUIT\r\n");
			fclose($SMTPIN);
		}
	return $talk;
	}
}
?>
