<?php
namespace MH\UserBundle\Document;

use FOS\UserBundle\Document\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class User extends BaseUser
{
    /**
     * @var string
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @var Doctrine\Common\Collections\Collection
     * @MongoDB\ReferenceMany(targetDocument="MH\UserBundle\Document\Group")
     */
    protected $groups = [];

    /**
     * @var string
     * @MongoDB\String
     */
    private $facebookId;

    /**
     * @var string
     * @MongoDB\String
     */
    private $googleId;

    /**
     * @var string
     * @MongoDB\String
     */
    private $githubId;

    /**
     * @var string
     * @MongoDB\String
     */
    private $linkedInId;

    /**
     * @var string
     * @MongoDB\String
     */
    private $windowsLiveId;

    public function __construct()
    {
        parent::__construct();
    }

    public function setEmail($email)
    {
        $this->email = $email;
        $this->setUsername($email);

        return $this;
    }

    public function setEmailCanonical($emailCanonical)
    {
        $this->emailCanonical = $emailCanonical;
        $this->setUsernameCanonical($emailCanonical);

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroups() {
        return $this->groups;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection
     * @return User
     */
    public function setGroups(\Doctrine\Common\Collections\Collection $groups) {
        $this->groups = $groups;

        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     * @return User
     */
    public function setOAuthProperty($name, $value)
    {
        switch ($name) {
            case 'facebookId': return $this->setFacebookId($value);
            case 'googleId': return $this->setGoogleId($value);
            case 'githubId': return $this->setGithubId($value);
            case 'linkedInId': return $this->setLinkedInId($value);
            case 'windowsLiveId': return $this->setWindowsLiveId($value);
        }
    }

    /**
     * @param string $name
     * @return string
     */
    public function getOAuthProperty($name)
    {
        switch ($name) {
            case 'facebookId': return $this->getFacebookId($value);
            case 'googleId': return $this->getGoogleId($value);
            case 'githubId': return $this->getGithubId($value);
            case 'linkedInId': return $this->getLinkedInId($value);
            case 'windowsLiveId': return $this->getWindowsLiveId($value);
        }
    }

    /**
     * @return string
     */
    public function getFacebookId() {
        return $this->facebookId;
    }

    /**
     * @param string
     * @return User
     */
    public function setFacebookId($facebookId) {
        $this->facebookId = $facebookId;

        return $this;
    }

    /**
     * @return string
     */
    public function getGoogleId() {
        return $this->googleId;
    }

    /**
     * @param string
     * @return User
     */
    public function setGoogleId($googleId) {
        $this->googleId = $googleId;

        return $this;
    }

    /**
     * @return string
     */
    public function getGithubId() {
        return $this->githubId;
    }

    /**
     * @param string
     * @return User
     */
    public function setGithubId($githubId) {
        $this->githubId = $githubId;

        return $this;
    }

    /**
     * @return string
     */
    public function getLinkedInId() {
        return $this->linkedInId;
    }

    /**
     * @param string
     * @return User
     */
    public function setLinkedInId($linkedInId) {
        $this->linkedInId = $linkedInId;

        return $this;
    }

    /**
     * @return string
     */
    public function getWindowsLiveId() {
        return $this->windowsLiveId;
    }

    /**
     * @param string
     * @return User
     */
    public function setWindowsLiveId($windowsLiveId) {
        $this->windowsLiveId = $windowsLiveId;

        return $this;
    }
}
