# Variables
NCC = ncc
PACKAGE_NAME = net.nosial.optslib.ncc
BUILD_CONFIG = release

# Directories
SRC_DIR = src
BUILD_DIR = build/$(BUILD_CONFIG)

.PHONY: all release install uninstall clean

all: release install

release: prepare_build
	$(NCC) build --config=$(BUILD_CONFIG)

install: prepare_build
	$(NCC) package install --package="$(BUILD_DIR)/$(PACKAGE_NAME)" --skip-dependencies -y

uninstall:
	$(NCC) package uninstall -y --package="$(PACKAGE_NAME)"

clean:
	rm -rf $(BUILD_DIR)

prepare_build:
	mkdir -p $(BUILD_DIR)