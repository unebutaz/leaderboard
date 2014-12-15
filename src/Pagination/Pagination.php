<?php

namespace Leaderboard\Pagination;

class Pagination implements \Countable
{
    /**
     * @var Paginatable
     */
    private $content;

    private $totalItems;
    private $totalPages;
    private $itemsPerPage = 5;
    private $currentPage = 1;

    public function __construct(Paginatable $content)
    {
        $this->content = $content;

        $this->totalItems = count($content);
        $this->totalPages = intval(ceil($this->totalItems / $this->itemsPerPage));
    }

    public function getPage($page)
    {
        $offset = ($page - 1) * $this->itemsPerPage;
        $limit = $page * $this->itemsPerPage - 1;

        return $this->content->getIterator($offset, $limit);
    }

    public function getPages()
    {
        for ($i = 1; $i <= $this->totalPages; ++$i) {
            yield $i;
        }
    }

    public function count()
    {
        return $this->totalPages;
    }
}
