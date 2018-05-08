<?php

namespace App\Forms;

use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class FindArticleForm extends Control
{

    public $onFindArticleSave;
    
    protected function createComponentFindArticleForm()
    {
        $form = new Form;

        $form->addText('title', 'Nadpis:');
        $form->addText('author', 'Autor:');
        $form->addText('date_from', 'Datum od')
                ->setType('date');
        $form->addText('date_to', 'Datum do')
                ->setType('date');
        $form->addSubmit('send', 'Odeslat')->setAttribute('class', 'ajax');
        $form->onSuccess[] = [$this, 'processForm'];

        return $form;
    }
    
    public function render()
    {
        $this->template->getLatte()->addProvider('formsStack', [$this["findArticleForm"]]);
        $this->template->setFile(__DIR__ . '/FindArticleForm.latte');   
        $this->template->form = $this['findArticleForm'];
        $this->template->render();
    }

    public function processForm($form)
    {

        $this->onFindArticleSave($this, $form->getValues());
     
    }
}

/** rozhranní pro generovanou továrničku */
interface IFindArticleFormFactory
{
    /** @return \App\Forms\FindArticleForm */
    function create();
}