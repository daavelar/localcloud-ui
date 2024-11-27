deploy:
	TAG=$(shell semver get release)
	docker build -t hub.docker.com/diegueradev/localcloud-ui:$TAG .
	docker push hub.docker.com/diegueradev/localcloud-ui:$TAG
