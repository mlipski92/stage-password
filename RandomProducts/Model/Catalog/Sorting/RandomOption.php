<?php
declare(strict_types=1);

namespace Mlipski\RandomProducts\Model\Catalog\Sorting;

use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Framework\DB\Select;
use Magento\Framework\Phrase;
use Magento\PageBuilder\Model\Catalog\Sorting\OptionInterface;
use Magento\Store\Model\Store;

class RandomOption implements OptionInterface
{
    /**
     * @var string
     */
    private $label;

    /**
     * @param string $label
     */
    public function __construct(
        string $label,
    ) {
        $this->label = $label;
    }

    /**
     * @inheritDoc
     */
    public function sort(Collection $collection): Collection
    {
        $collection->getSelect()->reset(Select::ORDER);
        $collection->getSelect()->order('RAND()');
        return $collection;
    }

    /**
     * @inheritdoc
     */
    public function getLabel(): Phrase
    {
        return __($this->label);
    }
}
