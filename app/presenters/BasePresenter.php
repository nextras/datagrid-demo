<?php

namespace NextrasDemos\Datagrid;

use Nette\Application\UI\Presenter;
use Nette\Utils\Paginator;


abstract class BasePresenter extends Presenter
{
	/** @var \Nette\Database\Context @inject */
	public $context;


	public function beforeRender()
	{
		parent::beforeRender();

		$this->template->header = __DIR__ . '/../templates/@header.latte';
		$this->redrawControl('flashes');
	}


	public function getDataSource($filter, $order, Paginator $paginator = NULL)
	{
		$selection = $this->prepareDataSource($filter, $order);
		if ($paginator) {
			$selection->limit($paginator->getItemsPerPage(), $paginator->getOffset());
		}
		$selection = iterator_to_array($selection);
		foreach ($selection as $i => $row) {
			//if ($row->id === 15144) $row->update(['id' => 0]);
		}
		return $selection;
	}


	public function getDataSourceSum($filter, $order)
	{
		return $this->prepareDataSource($filter, $order)->count('*');
	}


	private function prepareDataSource($filter, $order)
	{
		$filters = array();
		foreach ($filter as $k => $v) {
			if ($k === 'gender' || is_array($v))
				$filters[$k] = $v;
			else
				$filters[$k. ' LIKE ?'] = "%$v%";
		}

		$selection = $this->context->table('user')->where($filters);
		if ($order) {
			$selection->order(implode(' ', $order));
		}

		return $selection;
	}

}
