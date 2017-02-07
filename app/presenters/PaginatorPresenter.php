<?php

namespace NextrasDemos\Datagrid;

use Nextras\Datagrid\Datagrid;


final class PaginatorPresenter extends BasePresenter
{
	public function createComponentDatagrid()
	{
		$grid = new Datagrid;
		$grid->addColumn('id');
		$grid->addColumn('firstname');
		$grid->addColumn('surname');
		$grid->addColumn('birthday');

		$grid->setDataSourceCallback([$this, 'getDataSource']);
		$grid->setPagination(10, [$this, 'getDataSourceSum']);
		$grid->addCellsTemplate(__DIR__ . '/../../vendor/nextras/datagrid/bootstrap-style/@bootstrap3.datagrid.latte');
		$grid->addCellsTemplate(__DIR__ . '/../../vendor/nextras/datagrid/bootstrap-style/@bootstrap3.extended-pagination.datagrid.latte');
		return $grid;
	}
}
