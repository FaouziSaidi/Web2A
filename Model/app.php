<?php

class app
{
    private ?int $id;
    private ?int $user_id;
    private ?int $job_id;
    private ?int $type;

    public function __construct($id, $user_id, $job_id, $type)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->job_id = $job_id;
        $this->type = $type;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getJobId()
    {
        return $this->job_id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function setJobId($job_id)
    {
        $this->job_id = $job_id;
    }

    public function setType($type)
    {
        $this->type = $type;
    }
}
?>