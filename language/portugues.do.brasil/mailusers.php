<?php
// $Id: mailusers.php,v 1.1 2009/03/22 03:30:04 ohwada Exp $

//=========================================================
// WebLinks Module
// 2007-07-16 K.OHWADA
//=========================================================

//---------------------------------------------------------
// this file is for XC 2.1
// dont use this in XOOPS 2.0.x
// same as modules/system/language/english/admin/mailusers.php
//---------------------------------------------------------

//%%%%%%    Admin Module Name  MailUsers    %%%%%
define('_AM_DBUPDATED', _MD_AM_DBUPDATED);

//%%%%%%    mailusers.php   %%%%%
define('_AM_SENDTOUSERS', 'Enviar mensagens sos usuários cujos:');
define('_AM_SENDTOUSERS2', 'Enviar para:');
define('_AM_GROUPIS', 'Grupo é (opcional)');
define('_AM_TIMEFORMAT', '(Formato yyyy-mm-dd, opcional)');
define('_AM_LASTLOGMIN', 'Último login é depois');
define('_AM_LASTLOGMAX', 'Último login é antes');
define('_AM_REGDMIN', 'Dados registrados é depois');
define('_AM_REGDMAX', 'Dados registrados é antes');
define('_AM_IDLEMORE', 'Último login foi há mais de X dias (opcional)');
define('_AM_IDLELESS', 'Último login foi a menos que X dias atrás (opcional)');
define('_AM_MAILOK', 'Enviar mensagens somente para usuários que aceitaram receber mensagens de notificações (opcional)');
define('_AM_INACTIVE', 'Enviar somente mensagens para usuários inativos (opcional)');
define('_AMIFCHECKD', 'Se isso for assinalado, todas as mensagens privadas acima serão ignoradas');
define('_AM_MAILFNAME', 'Do Nome (somente email)');
define('_AM_MAILFMAIL', 'Do Email (somente email)');
define('_AM_MAILSUBJECT', 'Assunto');
define('_AM_MAILBODY', 'Corpo');
define('_AM_MAILTAGS', 'Tags úteis:');
define('_AM_MAILTAGS1', '{X_UID} imprimir o id do usuário');
define('_AM_MAILTAGS2', '{X_UNAME} imprimir o nome do usuário');
define('_AM_MAILTAGS3', '{X_UEMAIL} imprimir o email do usuário');
define('_AM_MAILTAGS4', '{X_UACTLINK} imprimir o link de ativação do usuário');
define('_AM_SENDTO', 'Enviar para');
define('_AM_EMAIL', 'Email');
define('_AM_PM', 'Mensagem Privada');
define('_AM_SENDMTOUSERS', 'Enviar mensagem aos usuários');
define('_AM_SENT', 'Usuários Enviados');
define('_AM_SENTNUM', '%s - %s (total: %s usuários)');
define('_AM_SENDNEXT', 'Próximo');
define('_AM_NOUSERMATCH', 'Nenhum usuário correspondente');
define('_AM_SENDCOMP', 'Finalizado o envio da mensagem.');
