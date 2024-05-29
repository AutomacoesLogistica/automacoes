"""Helpers: Information: get_frontend_version."""
import json

# pylint: disable=missing-docstring
import os

from custom_components.hacs.helpers.functions.information import get_frontend_version


def temp_cleanup(tmpdir):
    hacsdir = f"{tmpdir.dirname}/custom_components/hacs"
    manifestfile = f"{hacsdir}/manifest.json"
    if os.path.exists(manifestfile):
        os.remove(manifestfile)
    if os.path.exists(hacsdir):
        os.removedirs(hacsdir)


def test_get_frontend_version(hacs, tmpdir):
    hacsdir = f"{tmpdir.dirname}/custom_components/hacs"
    manifestfile = f"{hacsdir}/manifest.json"
    hacs.core.config_path = tmpdir.dirname

    data = {"requirements": ["hacs_frontend==999999999999"]}

    os.makedirs(hacsdir, exist_ok=True)
    with open(manifestfile, "w") as manifest_file:
        manifest_file.write(json.dumps(data))

    frontend_version = get_frontend_version()
    assert frontend_version == "999999999999"
    temp_cleanup(tmpdir)
