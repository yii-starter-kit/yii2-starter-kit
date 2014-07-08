<?php

return [
	'sourcePath' => dirname(__DIR__),
	'languages' => Yii::$app->l10n->languages,

	'translator' => 'Yii::t',
	// boolean, whether to sort messages by keys when merging new messages
	// with the existing ones. Defaults to false, which means the new (untranslated)
	// messages will be separated from the old (translated) ones.
	'sort' => false,
	// boolean, whether the message file should be overwritten with the merged messages
	'overwrite' => true,
	// boolean, whether to remove messages that no longer appear in the source code.
	// Defaults to false, which means each of these messages will be enclosed with a pair of '@@' marks.
	'removeUnused' => true,
	// array, list of patterns that specify which files/directories should NOT be processed.
	// If empty or not set, all files/directories will be processed.
	// A path matches a pattern if it contains the pattern string at its end. For example,
	// '/a/b' will match all files and directories ending with '/a/b';
	// the '*.svn' will match all files and directories whose name ends with '.svn'.
	// and the '.svn' will match all files and directories named exactly '.svn'.
	// Note, the '/' characters in a pattern matches both '/' and '\'.
	// See helpers/FileHelper::findFiles() description for more details on pattern matching rules.
	'only' => ['*.php'],
	// array, list of patterns that specify which files (not directories) should be processed.
	// If empty or not set, all files will be processed.
	// Please refer to "except" for details about the patterns.
	// If a file/directory matches both a pattern in "only" and "except", it will NOT be processed.
	'except' => [
		'.svn',
		'.git',
		'.gitignore',
		'.gitkeep',
		'.hgignore',
		'.hgkeep',
		'/messages',
	],

	// Generated file format. Can be either "php", "po" or "db".
	'format' => 'db',
	'db' => 'db',
	'sourceMessageTable' => '{{%i18_source_message}}',
	'messageTable' => '{{%i18_message}}',
];
