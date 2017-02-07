<?php

namespace NextrasDemos\Datagrid;

use Nette\Forms\Container;
use Nextras\Datagrid\Datagrid;


final class FullPresenter extends BasePresenter
{
	public function createComponentDatagrid()
	{
		$grid = new Datagrid;
		$grid->addColumn('id');
		$grid->addColumn('firstname')->enableSort($grid::ORDER_ASC);
		$grid->addColumn('surname')->enableSort();
		$grid->addColumn('gender')->enableSort();
		$grid->addColumn('birthday')->enableSort();
		$grid->addColumn('symbol', 'Symbol');

		$grid->setDataSourceCallback([$this, 'getDataSource']);
		$grid->setPagination(10, [$this, 'getDataSourceSum']);
		$grid->setFilterFormFactory(function() {
			$form = new Container;
			$form->addText('firstname');
			$form->addText('surname');
			$form->addSelect('gender', NULL, array(
				'male' => 'male',
				'female' => 'female',
			))->setPrompt('---')->setDefaultValue('male');

			return $form;
		});

		$grid->setEditFormFactory(function($row) {
			$form = new Container;
			$form->addText('firstname')->setRequired('You have to enter the first name');
			$form->addText('surname')->setRequired('You have to enter the last name.');
			!$row ?: $form->setDefaults($row);
			return $form;
		});

		$grid->setEditFormCallback([$this, 'saveData']);

		$grid->addCellsTemplate(__DIR__ . '/../../vendor/nextras/datagrid/bootstrap-style/@bootstrap3.datagrid.latte');
		$grid->addCellsTemplate(__DIR__ . '/../templates/Full/@cells.latte');
		return $grid;
	}


	public function saveData(Container $form)
	{
		$values = $form->getValues();
		$user = $this->context->table('user')->get($values->id);
		$user->update($values);

		$this->flashMessage('Saving data: ' . json_encode($form->getValues()));
		$this->redrawControl('flashes');
	}
}
