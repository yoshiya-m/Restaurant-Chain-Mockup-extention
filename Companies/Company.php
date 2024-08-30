<?php

namespace Companies\Restaurants;


class Company{
    private string $name;
    private int $foundingYear;
    private string $description;
    private string $website;
    private string $phone;
    private string $industry;
    private string $ceo;
    private bool $isPubliclyTraded;
    private string $country;
    private string $founder;
    private int $totalEmployees;

    public function __construct(
        string $name, int $foundingYear, string $description, string $website,
        string $phone, string $industry, string $ceo, bool $isPubliclyTraded,
        string $country, string $founder, int $totalEmployees,
    ) {
        $this->name = $name;
        $this->foundingYear = $foundingYear;
        $this->description = $description;
        $this->website = $website;
        $this->phone = $phone;
        $this->industry = $industry;
        $this->ceo = $ceo;
        $this->isPubliclyTraded = $isPubliclyTraded;
        $this->country = $country;
        $this->founder = $founder;
        $this->totalEmployees = $totalEmployees;
    }

    // 会社名、設立年、説明、ウェブサイト、連絡先の電話番号、業界、CEO の名前、
    // および公開取引されているかどうかを含む会社情報を表示するメソッド
    public function getName() {
        return $this->name;
    }
    public function getFoundingyear() {
        return $this->foundingYear;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getWebsite() {
        return $this->website;
    }
    public function getPhone() {
        return $this->phone;
    }
    public function getIndustry() {
        return $this->industry;
    }
    public function getCeo() {
        return $this->ceo;
    }
    public function getIsPubliclyTraded() {
        return $this->isPubliclyTraded;
    }
    public function getCountry() {
        return $this->country;
    }
    public function getFounder() {
        return $this->founder;
    }
    public function getTotalEmployees() {
        return $this->totalEmployees;
    }
    // public function toString(): string ;
    // public function toHTML(): string;
    // public function toMarkdown(): string;
    // public function toArray(): string;


}