"""Configuration Test Suite: can install."""
# pylint: disable=missing-docstring
from custom_components.hacs.helpers.classes.repository import HacsRepository


def test_hacs_can_install(hacs):
    repository = HacsRepository()
    repository.repository_manifest = {"test": "test"}
    repository.data.releases = True

    hacs.system.ha_version = "1.0.0"
    repository.data.homeassistant = "1.0.0b1"
    assert repository.can_install

    hacs.system.ha_version = "1.0.0b1"
    repository.data.homeassistant = "1.0.0"
    assert not repository.can_install

    hacs.system.ha_version = "1.0.0b1"
    repository.data.homeassistant = "1.0.0b2"
    assert not repository.can_install

    hacs.system.ha_version = "1.0.0"
    repository.data.homeassistant = "1.0.0"
    assert repository.can_install
