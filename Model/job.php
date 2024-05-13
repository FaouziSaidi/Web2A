<?php

class job
{
    private ?int $id;
    private ?string $title;
    private ?string $tags;
    private ?string $local;
    private ?float $salary;
    private ?int $period;
    private ?string $required_exp;
    private ?DateTime $date_of_creation;
    private ?string $others;

    public function __construct(
        ?int $id,
        ?string $title,
        ?string $tags,
        ?string $local,
        ?float $salary,
        ?int $period,
        ?string $required_exp,
        ?DateTime $date_of_creation,
        ?string $others
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->tags = $tags;
        $this->local = $local;
        $this->salary = $salary;
        $this->period = $period;
        $this->required_exp = $required_exp;
        $this->date_of_creation = $date_of_creation;
        $this->others = $others;
    }

    // Getter methods

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function getLocal(): ?string
    {
        return $this->local;
    }

    public function getSalary(): ?float
    {
        return $this->salary;
    }

    public function getPeriod(): ?int
    {
        return $this->period;
    }

    public function getRequiredExp(): ?string
    {
        return $this->required_exp;
    }

    public function getDateOfCreation(): ?DateTime
    {
        return $this->date_of_creation;
    }

    public function getOthers(): ?string
    {
        return $this->others;
    }
}
?>
