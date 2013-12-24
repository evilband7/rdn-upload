<?php

namespace RdnUpload;

use RdnUpload\Object\ObjectInterface;

/**
 * Renders a file's content lazily.
 */
class LazyResponse
{
	/**
	 * @var ObjectInterface
	 */
	protected $file;

	public function __construct(ObjectInterface $file)
	{
		$this->file = $file;
	}

	public function __toString()
	{
		return $this->file->getContent();
	}
}
