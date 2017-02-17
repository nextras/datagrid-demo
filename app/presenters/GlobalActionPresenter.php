<?php

namespace NextrasDemos\Datagrid;

use Nextras\Datagrid\Datagrid;


final class GlobalActionPresenter extends BasePresenter
{
	public function createComponentDatagrid()
	{
		$grid = new Datagrid();
		$grid->addColumn('id');
		$grid->addColumn('firstname')->enableSort($grid::ORDER_ASC);
		$grid->addColumn('surname')->enableSort();
		$grid->addColumn('gender')->enableSort();
		$grid->addColumn('birthday')->enableSort();

		$grid->setDataSourceCallback([$this, 'getDataSource']);
		$grid->setPagination(10, [$this, 'getDataSourceSum']);
		$grid->addGlobalAction('delete', 'Delete', function (array $ids, Datagrid $grid) {
			foreach ($ids as $id) {
				$this->context->table('user')->where('id', $id)->delete();
			}
			$grid->redrawControl('rows');
		});

		$grid->addCellsTemplate(__DIR__ . '/../../vendor/nextras/datagrid/bootstrap-style/@bootstrap3.datagrid.latte');
		return $grid;
	}
}
