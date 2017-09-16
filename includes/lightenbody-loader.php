<?php

/**
 * Class Lightenbody_Loader
 */
class Lightenbody_Loader
{
	protected $actions;
	protected $filters;

	public function __construct()
    {
		$this->actions = array();
		$this->filters = array();
	}

    /**
     * @param $hook
     * @param $component
     * @param $callback
     * @param int $priority
     * @param int $accepted_args
     */
	public function add_action($hook, $component, $callback, $priority = 10, $accepted_args = 1)
    {
		$this->actions = $this->add($this->actions, $hook, $component, $callback, $priority, $accepted_args);
	}

    /**
     * @param $hook
     * @param $component
     * @param $callback
     * @param int $priority
     * @param int $accepted_args
     */
	public function add_filter($hook, $component, $callback, $priority = 10, $accepted_args = 1)
    {
		$this->filters = $this->add($this->filters, $hook, $component, $callback, $priority, $accepted_args);
	}

    /**
     * @param $hooks
     * @param $hook
     * @param $component
     * @param $callback
     * @param $priority
     * @param $accepted_args
     * @return array
     */
	private function add($hooks, $hook, $component, $callback, $priority, $accepted_args)
    {
		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args
		);

		return $hooks;
	}

	public function bootstrap()
    {
		foreach ($this->filters as $hook)
		{
			add_filter($hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args']);
		}

		foreach ($this->actions as $hook)
		{
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args']);
		}
	}
}
