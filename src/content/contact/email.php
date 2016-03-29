<?php
/**Classe para envio de emails.
* @package Classes
* @copyright Comercial/Proprietário
* @author Manoel Campos da Silva Filho. http://manoelcampos.com/contato
*/
class Email { 
   /**@property string NAME Nome da conta para envio do email, que aparecerá
   * como remetente da mensagem*/
   var $name = "Manoel Campos Blog";
   /**@property string FROM Endereço de email do remetente da mensagem*/
   var $from = "manoelcampos@gmail.com";

   /**Envia um email.
	 * @param string $assunto Assunto da mensagem de email
	 * @param string $body Corpo da mensagem de email
	 * @param string $destinatario Destinatário da mensagem
	 * @param bool $copia_oculta Indica se é pra ser enviada uma cópia oculta
	 * da mensagem para o endereço do remetente.
	 * @return bool Retorna true se o email for enviado com sucesso*/
   function send($assunto, $body, $destinatario, $copia_oculta=false) {
	  $headers = "MIME-Version: 1.1\n";
	  $headers .= "Content-type: text/html; charset=utf-8\n";
      $headers .= "X-Mailer: PHP/" . phpversion() . "\n";
      $from = $this->name . " <" . $this->from . ">";
	  $replyto = $from;
	  $headers .= "From: $from\n"; // remetente
      if($copia_oculta)
          $headers .= "Bcc: $from\n";  
	  $headers .= "Return-Path: $replyto\n"; // return-path
      //A mensagem não pode ter mais que 70 caracteres por linha, segundo documentação da função mail.
      $body = wordwrap($body, 70);
	  $envio = mail($destinatario, $assunto, $body, $headers);
	  //echo "<div style='border:dashed'>$body</div><p/>";
	  return $envio;
   }
}
?>
