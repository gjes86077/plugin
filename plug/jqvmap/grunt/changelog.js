module.exports = {
	release: {
		options: {
			insertType: "prepend",
			template: "## Release v<%= package.version %>:\n{{> features}}{{> fixes}}\n",
			partials: {
				features: "#### Features:\n{{#if features}}{{#each features}}{{> feature}}{{/each}}{{else}}{{> empty}}{{/if}}\n",
				fixes: "#### Bugfixes:\n{{#if fixes}}{{#each fixes}}{{> fix}}{{/each}}{{else}}{{> empty}}{{/if}}",
				empty: " - (none)\n"
			},
			dest: "CHANGELOG.md"
		}
	}
};