<?php

abstract class Page
{
    public string $title;

    protected function HTTPHeaders(): void
    {

    }

    protected function HTMLHead(): string
    {
        return MustacheProvider::get()->render("htmlHead", ["title" => $this->title]);
    }

    protected function HTMLPageHeader(): string
    {
        return MustacheProvider::get()->render("pageHeader", []);
    }

    protected abstract function HTMLPageBody(): string;


    public function render(): void
    {
        // Posle HTTP hlavicky
        $this->HTTPHeaders();

        $pageData = [];

        // Ziska hlavicky
        $pageData["htmlHead"] = $this->HTMLHead();
        // Ziska zahlavi
        $pageData["pageHeader"] = $this->HTMLPageHeader();
        // Ziska telo
        $pageData["pageBody"] = $this->HTMLPageBody();
        // Preda sablone stranky data pro vykresleni
        echo MustacheProvider::get()->render("page", $pageData);
    }
}
