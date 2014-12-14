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
        $this->totalPages = $this->totalItems % $this->itemsPerPage + 1;
    }

    public function getPage($page)
    {
        $offset = $page * $this->itemsPerPage;
        $limit = $this->itemsPerPage;
        return $this->content->getIterator($offset, $limit);
    }

    public function getPages()
    {
        for ($i=1; $i <= $this->totalPages; ++$i) {
            yield $i;
        }
    }

    public function count()
    {
        return $this->totalPages;
    }
}
