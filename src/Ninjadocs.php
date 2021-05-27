<?php

namespace Ninjami\Ninjadocs;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Parsedown;

class Ninjadocs
{
	protected $fileName;

	/**
	 * Lines
	 *
	 * @var array
	 */
	protected $lines;

	/**
	 * @param string $fileName
	 */
	public function __construct($fileName)
	{
		$this->fileName = $fileName;
		$this->lines = $this->linesFromFile($this->fileName);
	}

	public function test()
	{
		return 'lol';
	}

	/**
	 * Get content from file and parse to html
	 */
	public function linesFromFile($fileName)
	{
		// Find .md file
		$file = $this->getFile($fileName);

		$parser = new Parser();
		$lines = $parser->textToLines($file);

		return $lines;
	}

	/**
	 * Get file
	 */
	private function getFile($fileName)
	{
		// File should be .md
		$fileExtension = '.md';

		// File path
		$filePath = resource_path('documentation/' . $fileName . $fileExtension);

		// if no file found in path, return error
		if (!file_exists($filePath)) {
			abort(404);
		}

		// Get file
		$file = file_get_contents($filePath);

		return $file;
	}


	/**
	 * Get content as html
	 */
	public function html()
	{
		# Create markup
		$parser = new Parser();
		$html = $parser->linesToMarkup($this->lines);

		return $html;
	}

	/**
	 * Get lines
	 */
	public function lines()
	{
		return $this->lines;
	}
}

// Extend Parsedown
class Parser extends Parsedown
{
	public function textToLines($text)
	{
		# make sure no definitions are set
		$this->DefinitionData = array();
		# standardize line breaks
		$text = str_replace(array("\r\n", "\r"), "\n", $text);
		# remove surrounding line breaks
		$text = trim($text, "\n");
		# split text into lines
		$lines = explode("\n", $text);
		# iterate through lines to identify blocks
		$lines = $this->linesAsObjects($lines);

		return $lines;
	}

	#
	# Cutomized Blocks function
	#

	protected function linesAsObjects(array $lines)
	{
		$CurrentBlock = null;

		foreach ($lines as $line) {
			if (chop($line) === '') {
				if (isset($CurrentBlock)) {
					$CurrentBlock['interrupted'] = true;
				}

				continue;
			}

			if (strpos($line, "\t") !== false) {
				$parts = explode("\t", $line);

				$line = $parts[0];

				unset($parts[0]);

				foreach ($parts as $part) {
					$shortage = 4 - mb_strlen($line, 'utf-8') % 4;

					$line .= str_repeat(' ', $shortage);
					$line .= $part;
				}
			}

			$indent = 0;

			while (isset($line[$indent]) and $line[$indent] === ' ') {
				$indent++;
			}

			$text = $indent > 0 ? substr($line, $indent) : $line;

			# ~

			$Line = array('body' => $line, 'indent' => $indent, 'text' => $text);

			# ~

			if (isset($CurrentBlock['continuable'])) {
				$Block = $this->{'block' . $CurrentBlock['type'] . 'Continue'}($Line, $CurrentBlock);

				if (isset($Block)) {
					$CurrentBlock = $Block;

					continue;
				} else {
					if ($this->isBlockCompletable($CurrentBlock['type'])) {
						$CurrentBlock = $this->{'block' . $CurrentBlock['type'] . 'Complete'}($CurrentBlock);
					}
				}
			}

			# ~

			$marker = $text[0];

			# ~

			$blockTypes = $this->unmarkedBlockTypes;

			if (isset($this->BlockTypes[$marker])) {
				foreach ($this->BlockTypes[$marker] as $blockType) {
					$blockTypes[] = $blockType;
				}
			}

			#
			# ~

			foreach ($blockTypes as $blockType) {
				$Block = $this->{'block' . $blockType}($Line, $CurrentBlock);

				if (isset($Block)) {
					$Block['type'] = $blockType;

					if (!isset($Block['identified'])) {
						$Blocks[] = $CurrentBlock;

						$Block['identified'] = true;
					}

					if ($this->isBlockContinuable($blockType)) {
						$Block['continuable'] = true;
					}

					$CurrentBlock = $Block;

					continue 2;
				}
			}

			# ~

			if (isset($CurrentBlock) and !isset($CurrentBlock['type']) and !isset($CurrentBlock['interrupted'])) {
				$CurrentBlock['element']['text'] .= "\n" . $text;
			} else {
				$Blocks[] = $CurrentBlock;

				$CurrentBlock = $this->paragraph($Line);

				$CurrentBlock['identified'] = true;
			}
		}

		# ~

		if (isset($CurrentBlock['continuable']) and $this->isBlockCompletable($CurrentBlock['type'])) {
			$CurrentBlock = $this->{'block' . $CurrentBlock['type'] . 'Complete'}($CurrentBlock);
		}

		# ~

		$Blocks[] = $CurrentBlock;

		unset($Blocks[0]);

		# ~

		foreach ($Blocks as $key => $Block) {
			if (isset($Block['hidden'])) {
				continue;
			}

			// Add link if is header
			if (isset($Block['type']) && $Block['type'] == 'Header') {
				$Blocks[$key]['link'] = Str::slug($Block['element']['text']);
			}
		}

		# ~

		return $Blocks;
	}

	/* Generate markup from lines array */
	public function linesToMarkup(array $lines)
	{
		# ~

		$markup = '';

		foreach ($lines as $Block) {
			if (isset($Block['hidden'])) {
				continue;
			}

			$markup .= "\n";

			// Add link if is link
			if (isset($Block['link'])) {
				$markup .= '<a href="#' . $Block['link'] . '" id="' . $Block['link'] . '" class="anchor">';
			}
			$markup .= isset($Block['markup']) ? $Block['markup'] : $this->element($Block['element']);

			// End link if is link
			if (isset($Block['link'])) {
				$markup .= '</a>';
			}
		}

		$markup .= "\n";

		# ~

		return $markup;
	}
}
