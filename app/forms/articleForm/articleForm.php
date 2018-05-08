<?php

namespace App\Forms;

use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class ArticleForm extends Control
{

    public $onArticleSave;
    
    protected function createComponentArticleForm()
    {
        $form = new Form;

        $form->addText('title', 'Nadpis:')->setRequired(true);
        $form->addText('content', 'Obsah:')->setRequired(true);
        $form->addText('author', 'Autor:')->setRequired(true);
        $form->addUpload('picture', 'Obrázek:')->setRequired(true)->addRule(Form::IMAGE, 'Obrázek musí být JPEG, PNG nebo GIF.');
        $form->addSubmit('send', 'Odeslat');
        $form->onSuccess[] = [$this, 'processForm'];

        return $form;
    }
    
    public function render()
    {
        $this->template->getLatte()->addProvider('formsStack', [$this["articleForm"]]);
        $this->template->setFile(__DIR__ . '/ArticleForm.latte');   
        $this->template->form = $this['articleForm'];
        $this->template->render();
    }

    public function processForm($form)
    {

        $this->onArticleSave($this, $form->getValues());
     
    }
}

/** rozhranní pro generovanou továrničku */
interface IArticleFormFactory
{
    /** @return \App\Forms\ArticleForm */
    function create();
}