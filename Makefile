debug:
	ncc build --config="debug"

release:
	ncc build --config="release"

install:
	ncc package install --package="build/release/net.nosial.optslib.ncc"

install-debug:
	ncc package install --package="build/debug/net.nosial.optslib.ncc"

uninstall:
	ncc package uninstall -y --package="net.nosial.optslib"