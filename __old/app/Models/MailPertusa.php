<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailPertusa extends Model
{  
  private $from;
  private $from_name = "";
  private $type = "text/html";
  private $encoding = "utf-8";
  private $notify = false;

  /* Конструктор принимающий обратный e-mail адрес */
  public function __construct($from) {
    $this->from = $from;
  }

  /* Изменение обратного e-mail адреса */
  public function setFrom($from) {
    $this->from = $from;
  }

  /* Изменение имени в обратном адресе */
  public function setFromName($from_name) {
    $this->from_name = $from_name;
  }

  /* Изменение типа содержимого письма */
  public function setType($type) {
    $this->type = $type;
  }

  /* Нужно ли запрашивать подтверждение письма */
  public function setNotify($notify) {
    $this->notify = $notify;
  }

  /* Изменение кодировки письма */
  public function setEncoding($encoding) {
    $this->encoding = $encoding;
  }

  /* Метод отправки письма */
  public function send($to, $subject, $message) {
    $from = "=?utf-8?B?".base64_encode($this->from_name)."?="." <".$this->from.">"; // Кодируем обратный адрес (во избежание проблем с кодировкой)
    $headers = "From: ".$from."\r\nReply-To: ".$from."\r\nContent-type: ".$this->type."; charset=".$this->encoding."\r\n"; // Устанавливаем необходимые заголовки письма
    if ($this->notify) $headers .= "Disposition-Notification-To: ".$this->from."\r\n"; // Добавляем запрос подтверждения получения письма, если требуется
    $subject = "=?utf-8?B?".base64_encode($subject)."?="; // Кодируем тему (во избежание проблем с кодировкой)
    return mail($to, $subject, $message, $headers); // Отправляем письмо и возвращаем результат
  }
  
}
/*
 $mail = new Mail("no-reply@mysite.ru"); // Создаём экземпляр класса
  $mail->setFromName("Иван Иванов"); // Устанавливаем имя в обратном адресе
  if ($mail->send("abc@mail.ru", "Тестирование", "Тестирование<br /><b>письма<b>")) echo "Письмо отправлено";
  else echo "Письмо не отправлено";
 */