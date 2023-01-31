<?php

abstract class Page
{
    public string $title;

    protected function prepareData(): void
    {

    }

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
        try {
            $this->prepareData();

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
        } catch (BaseException $exception) {
            $exceptionPage = new ExceptionPage($exception);
            $exceptionPage->render();
            exit;
        } catch (Exception $exception) {
            if(AppConfig::get("debug")) throw $exception;

            $exception = new BaseException();
            $exceptionPage = new ExceptionPage($exception);
            $exceptionPage->render();
            exit;
        }

    }
}
