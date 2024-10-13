# Variables
DEFAULT_CONFIGURATION ?= release
LOG_LEVEL = debug

# Default Target
all: release release-executable

# Build Steps
release:
	ncc build --config=release --log-level $(LOG_LEVEL)
release-executable:
	ncc build --config=release-executable --log-level $(LOG_LEVEL)


install: release
	ncc package install --package=build/release/net.nosial.optslib.ncc --skip-dependencies --build-source --reinstall -y --log-level $(LOG_LEVEL)

test: release
	[ -f phpunit.xml ] || { echo "phpunit.xml not found"; exit 1; }
	phpunit

clean:
	rm -rf build

.PHONY: all install test clean release release-executable