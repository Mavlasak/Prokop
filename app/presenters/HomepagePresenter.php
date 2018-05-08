<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI;
use App\Model\ArticleManager;

class HomepagePresenter extends Nette\Application\UI\Presenter {

    /** @var \App\Forms\IArticleFormFactory @inject */
    public $articleFormFactory;

    /** @var \App\Forms\IFindArticleFormFactory @inject */
    public $findArticleFormFactory;

    /** @var articleManager */
    protected $articleManager;

    public function __construct(ArticleManager $articleManager) {
        $this->articleManager = $articleManager;
    }

    protected function createComponentArticleForm() {
        $control = $this->articleFormFactory->create();
        $control->onArticleSave[] = function (\App\Forms\ArticleForm $articleForm, $values) {

            $picture = $values->picture;
            $imageSize = $picture->getImageSize();
            if (($imageSize[0] == 500) && ($imageSize[1] == 500)) {
                $picture->move(__DIR__ . '/../../www/pictures/' . $picture->getName());
                $values->picture = $picture->getName();
                $this->articleManager->saveArticle($values);
            } else {
                $this->flashMessage('Rozměry obrázku musí být 500px x 500px.');
            }
            $this->redirect('this');
        };

        return $control;
    }

    protected function createComponentFindArticleForm() {
        $control = $this->findArticleFormFactory->create();
        $control->onFindArticleSave[] = function (\App\Forms\FindArticleForm $findArticleForm, $values) {
            $this->template->Articles = $this->articleManager->getArticles($values);
            $this->redrawControl('articleTable');
        };
        return $control;
    }

}
