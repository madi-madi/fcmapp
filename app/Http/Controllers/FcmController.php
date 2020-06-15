<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FcmController extends Controller
{
    /**
     * @internal
     *
     * @var null|string
     */
    protected $title;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $body;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $icon;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $sound;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $channelId;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $badge;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $tag;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $color;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $clickAction;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $bodyLocationKey;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $bodyLocationArgs;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $titleLocationKey;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $titleLocationArgs;

    /**
     * Title must be present on android notification and ios (watch) notification.
     *
     * @param string $title
     */
    public function __construct($title = null)
    {
        $this->title = $title;
    }


    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }


    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }


    public function setChannelId($channelId)
    {
        $this->channelId = $channelId;

        return $this;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }


    public function setSound($sound)
    {
        $this->sound = $sound;

        return $this;
    }


    public function setBadge($badge)
    {
        $this->badge = $badge;

        return $this;
    }


    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }


    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    public function setClickAction($action)
    {
        $this->clickAction = $action;

        return $this;
    }


    public function setTitleLocationKey($titleKey)
    {
        $this->titleLocationKey = $titleKey;

        return $this;
    }


    public function setTitleLocationArgs($titleArgs)
    {
        $this->titleLocationArgs = $titleArgs;

        return $this;
    }

    /**
     * Indicates the key to the body string for localization.
     *
     * @param string $bodyKey
     *
     * @return PayloadNotificationBuilder current instance of the builder
     */
    public function setBodyLocationKey($bodyKey)
    {
        $this->bodyLocationKey = $bodyKey;

        return $this;
    }


    public function setBodyLocationArgs($bodyArgs)
    {
        $this->bodyLocationArgs = $bodyArgs;

        return $this;
    }

    /**
     * Get title.
     *
     * @return null|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get body.
     *
     * @return null|string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Get channel id for android api >= 26
     *
     * @return null|string
     */
    public function getChannelId()
    {
        return $this->channelId;
    }

    /**
     * Get Icon.
     *
     * @return null|string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Get Sound.
     *
     * @return null|string
     */
    public function getSound()
    {
        return $this->sound;
    }

    /**
     * Get Badge.
     *
     * @return null|string
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * Get Tag.
     *
     * @return null|string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Get Color.
     *
     * @return null|string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Get ClickAction.
     *
     * @return null|string
     */
    public function getClickAction()
    {
        return $this->clickAction;
    }

    /**
     * Get BodyLocationKey.
     *
     * @return null|string
     */
    public function getBodyLocationKey()
    {
        return $this->bodyLocationKey;
    }

    /**
     * Get BodyLocationArgs.
     *
     * @return null|string|array
     */
    public function getBodyLocationArgs()
    {
        return $this->bodyLocationArgs;
    }

    /**
     * Get TitleLocationKey.
     *
     * @return string
     */
    public function getTitleLocationKey()
    {
        return $this->titleLocationKey;
    }

    /**
     * GetTitleLocationArgs.
     *
     * @return null|string|array
     */
    public function getTitleLocationArgs()
    {
        return $this->titleLocationArgs;
    }

    public  function sendTo($device_token=null,$title="FCMAPP",$body="FCMAPP BODY",$icon=null,$data) {

        $notification = [
            'title' => $title,
            'body' => $body,
            'icon' => $icon?$icon:"https://scontent.fgza9-1.fna.fbcdn.net/v/t1.0-9/29066728_427456654335132_7484668120364220416_n.png?_nc_cat=105&_nc_sid=85a577&_nc_ohc=zV1lc8g4S_EAX_3h0rl&_nc_ht=scontent.fgza9-1.fna&oh=c97c87eb73e399813b73daef041c95bb&oe=5F06F055",

        ];
        $notification = array_filter($notification, function($value) {
            return $value !== null;
        });


        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array (
                'registration_ids' => $device_token,
                'notification' => $notification,
                 'data'=>['fcmapp'=>$data]
        );
        $fields = json_encode ( $fields );
        $headers = array (
                'Authorization: key=' . config('fcmapp.server_key'),
                'Content-Type: application/json'
        );
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

        $result = curl_exec ( $ch );
        curl_close ( $ch );
        return $result;

    }
}
