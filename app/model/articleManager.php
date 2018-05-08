<?php

namespace App\Model;

use Nette\Database\Context;
use Nette\Utils\DateTime;

class ArticleManager {

    const TABLE_NAME = "articles",
            COLUMN_ID = "id",
            COLUMN_TITLE = "title",
            COLUMN_CONTENT = "content",
            COLUMN_AUTHOR = "author",
            COLUMN_PICTURE = "picture",
            COLUMN_CREATED_AT = "created_at";

    protected $database;

    public function __construct(Context $database) {
        $this->database = $database;
    }

    public function saveArticle($values) {
        $this->database->table(self::TABLE_NAME)->insert($values);
    }

    public function getArticles($values, $column = self::COLUMN_CREATED_AT) {

        $values['date_to'] = DateTime::from($values['date_to'])->modifyClone('+1 day');

        $Articles = $this->database->table(self::TABLE_NAME)
                ->where(self::COLUMN_TITLE . ' LIKE CONCAT("%", ? ,"%")', $values['title'])
                ->where(self::COLUMN_AUTHOR . ' LIKE CONCAT("%", ? ,"%")', $values['author']);
        if (!empty($values['date_from'])) {
            $Articles->where(self::COLUMN_CREATED_AT . '> ?', $values['date_from']);
        }
        if (!empty($values['date_to'])) {
            $Articles->where(self::COLUMN_CREATED_AT . '< ?', $values['date_to']);
        }

        return $Articles->order($column)->fetchAll();
    }

}
