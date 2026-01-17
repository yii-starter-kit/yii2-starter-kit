<?php

class AdminerForeignKeys {
	function head() {
		?>
		<script<?php echo Adminer\nonce(); ?>>
			document.addEventListener("DOMContentLoaded", function()
			{
				collapsable = document.getElementsByClassName('collapsable')

				for (item of collapsable) {
					item.addEventListener('click', function () {
						moreDiv = this.parentElement.getElementsByClassName('fk-more')[0]

						if (moreDiv.classList.contains('hidden')) {
							moreDiv.classList.remove('hidden')
							this.innerHTML = " [<a>less</a>]"
						} else {
							moreDiv.classList.add('hidden')
							this.innerHTML = " [<a>more</a>]"
						}

					})
				}
			})
		</script>
		<style>
			.collapsable {
				cursor: pointer;
			}
		</style>
		<?php

		return true;
	}


	function backwardKeys($table, $tableName) {
		$connection = Adminer\connection();

		$database = $connection->query('SELECT DATABASE() AS db;')->fetch_assoc();
		$result = $connection->query(sprintf('SELECT TABLE_NAME,COLUMN_NAME,REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE REFERENCED_TABLE_NAME = \'%s\' AND CONSTRAINT_SCHEMA = \'%s\';', $tableName, $database['db']));

		$backwardKeys = [];
		$i = 0;

		if ($result) {
			while ($row = $result->fetch_assoc()) {
				$backwardKeys[$row['TABLE_NAME'] . $i] = [
					'tableName' => $row['TABLE_NAME'],
					'columnName' =>$row['COLUMN_NAME'],
					'referencedColumnName' =>$row['REFERENCED_COLUMN_NAME'],
				];
				$i++;
			}
		}

		ksort($backwardKeys);

		return $backwardKeys;
	}

	function backwardKeysPrint($backwardKeys, $row) {
		$iterator = 0;

		foreach ($backwardKeys as $backwardKey) {
			$iterator++;
			$whereLink = Adminer\where_link(1, $backwardKey['columnName'], $row[$backwardKey['referencedColumnName']]);
			$link = sprintf('select=%s%s', $backwardKey['tableName'], $whereLink);

			if ($iterator === 2) {
				echo '<div class="fk-more hidden">';
			}

			echo sprintf("<a href='%s'>%s</a>%s\n", Adminer\h(Adminer\ME . $link), $backwardKey['tableName'], ($iterator === 1 && count($backwardKeys) > 1) ? '<span class="collapsable"> [<a>more</a>]</span>' : '');

			if ($iterator === count($backwardKeys)) {
				echo '</div>';
			}
		}

		echo '</div>';
	}
}

return new AdminerForeignKeys();
