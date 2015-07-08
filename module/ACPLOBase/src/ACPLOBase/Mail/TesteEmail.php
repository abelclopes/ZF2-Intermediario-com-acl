<?php
namespace ACPLOBase\Mail;
use Zend\Mail;
use Zend\Mail\Transport;
class TesteEmail

{

    /**
     * Variable registry for template values
     */
    protected $templateVariables = array();

    /**
     * Template name
     */
    protected $templateName;

    /**
     * Zend_Mail instance
     */
    protected $zendMail;

    /**
     * Email recipient
     */
    protected $recipient;

    /**
     * __construct
     *
     * Set default options
     */
    public function __construct()
    {
        $this->zendMail = new M();
    }

    /**
     * Set variables for use in the templates
     *
     * Magic function stores the value put in any variable in this class for
     * use later when creating the template
     *
     * @param string $name
     *            The name of the variable to be stored
     * @param mixed $value
     *            The value of the variable
     */
    public function __set($name, $value)
    {
        $this->templateVariables[$name] = $value;
    }

    /**
     * Set the template file to use
     *
     * @param string $filename
     *            Template filename
     */
    public function setTemplate($filename)
    {
        $this->templateName = $filename;
    }

    /**
     * Set the recipient address for the email message
     *
     * @param string $email
     *            Email address
     */
    public function setRecipient($email)
    {
        $this->recipient = $email;
    }

    /**
     * Send the constructed email
     *
     * @todo Add from name
     */
    public function send()
    {
        /*
         * Get data from config
         * - From address
         * - Directory for template files
         */
        $config = Zend_Registry::get('Config');
        $templateDir = $config->email->template->dir;
        $fromAddr = $config->email->from;
        $templateVars = $config->email->vars->toArray();
        
        foreach ($templateVars as $key => $value) {
            // If a variable is present in config which has not been set
            // add it to the list
            if (! array_key_exists($key, $this->templateVariables)) {
                $this->{$key} = $value;
            }
        }
        
        // Build template
        // Check that template file exists before using
        $viewConfig = array(
            'basePath' => $templateDir
        );
        $subjectView = new Zend_View($viewConfig);
        foreach ($this->templateVariables as $key => $value) {
            $subjectView->{$key} = $value;
        }
        try {
            $subject = $subjectView->render($this->templateName . '.subj');
        } catch (Zend_View_Exception $e) {
            $subject = false;
        }
        
        $textView = new Zend_View($viewConfig);
        foreach ($this->templateVariables as $key => $value) {
            $textView->{$key} = $value;
        }
        try {
            $text = $textView->render($this->templateName . '.txt');
        } catch (Zend_View_Exception $e) {
            $text = false;
        }
        
        $htmlView = new Zend_View($viewConfig);
        foreach ($this->templateVariables as $key => $value) {
            $htmlView->{$key} = $value;
        }
        try {
            $html = $htmlView->render($this->templateName . '.html');
        } catch (Zend_View_Exception $e) {
            $html = false;
        }
        
        // var_dump($subject);
        // var_dump($text);
        // var_dump($html);
        
        // Pass variables to Zend_Mail
        $mail = new Zend_Mail();
        // var_dump($fromAddr);
        $mail->setFrom($fromAddr);
        // var_dump($this->recipient);
        $mail->addTo($this->recipient);
        
        $mail->setSubject($subject);
        
        $mail->setBodyText($text);
        if ($html !== false) {
            $mail->setBodyHtml($html);
        }
        
        // Send email
        // $config = Zend_Registry::get('configuration');
        $transport = $config->email->transport;
        if ($transport == 'Dev') {
            $tr = new Acai_Mail_Transport_Dev();
            $mail->send($tr);
            return;
        }
        $mail->send();
    }
}