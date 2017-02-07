all:
	@echo "Building the site"
	php ./spress.phar site:build --env=prod 

clean:
	rm -rf build/*

publish: all aws

aws:
	@echo "Publishing blog to Amazon S3"
	#cd build/ && php -S localhost:8080 && cd ..
	aws --version
	aws s3 sync  build/ s3://manoelcampos.com/  --exclude ".git/*"
