# Run basic linting with prettier & phpstan
lint:
	@cd util/ \
		&& . $$NVM_DIR/nvm.sh && nvm use \
		&& npm i \
		&& npm run lint
	@composer lint

# Build JS sources (for media picker)
build:
	@cd js/ \
		&& . $$NVM_DIR/nvm.sh && nvm use \
		&& npm i \
		&& npm run build

# Make prettier process and fix all files in src/
prettier:
	@cd util/ \
		&& . $$NVM_DIR/nvm.sh && nvm use \
		&& npm i \
		&& npx prettier -w --config .prettierrc ../src

# Create a tagged release to publish a new version of the package
release:  lint
	@cd util/ \
	&& . $$NVM_DIR/nvm.sh && nvm use \
	&& npm i \
	&& npm run release

