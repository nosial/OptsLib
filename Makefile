release:
	ncc build --config="release"

install:
	ncc package install --package="build/release/net.nosial.optslib.ncc" --skip-dependencies --reinstall -y

uninstall:
	ncc package uninstall -y --package="net.nosial.optslib"