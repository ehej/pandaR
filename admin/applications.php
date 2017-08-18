<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.OrdersTable");

class IndexPage extends AdminPage {

	/**
	 *
	 * @var ApplicationsTable
	 */
	public $applicationsTable;

	function index() {
		parent::index();
		
		$this->setPageTitle('Заявки');
		$this->setBoldMenu('applications');

		$this->applicationsTable = new OrdersTable($this->connection);
		
		$this->setFilters();
	}

	function setFilters() {
		$this->sfilter = array();

		$this->sfilter['sortBy'] = $this->request->getString('sortBy');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder');

		$this->page = $this->request->getNumber('page', null, 1);
	}

	function OnGetNewApp() {
		$this->sfilter['varIsNew'] = 'yes';
	}
	
	function OnDelete() {
		$this->addMessage('Заявка удалена');
		$app['intOrderID'] = $this->request->getNumber('intOrderID');
		$this->applicationsTable->Delete($app);

		$this->response->redirect('applications.php?page='.$this->page);
	}

	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder'])?'DESC':'ASC';
		else $sort['intOrderID'] = 'DESC';

		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);

		$applications_list = $this->applicationsTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, 20);		
		$this->document->addValue('applications_list', $applications_list);

		if (isset($applications_list['pager']) && isset($applications_list['pager']['total'])) {
			$this->document->addValue('total_items', $applications_list['pager']['total']);
		} else {
			$this->document->addValue('total_items', count($applications_list));
		}
	}
}

Kernel::ProcessPage(new IndexPage("applications.tpl"));