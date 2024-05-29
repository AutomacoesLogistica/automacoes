"""HACS Repository Helper properties."""
# pylint: disable=missing-docstring
from custom_components.hacs.helpers.classes.repository import HacsRepository


def test_repository_helpers_properties_can_be_installed():
    repository = HacsRepository()
    assert repository.can_be_installed


def test_repository_helpers_properties_custom():
    repository = HacsRepository()

    repository.data.full_name = "test/test"
    repository.data.full_name_lower = "test/test"
    assert repository.custom

    repository.data.id = 1337
    repository.hacs.common.default.append(str(repository.data.id))
    assert not repository.custom

    repository.hacs.common.default = []
    assert repository.custom

    repository.data.full_name = "hacs/integration"
    repository.data.full_name_lower = "hacs/integration"
    assert not repository.custom


def test_repository_helpers_properties_pending_update():
    repository = HacsRepository()
    repository.hacs.system.ha_version = "0.109.0"
    repository.data.homeassistant = "0.110.0"
    repository.data.releases = True
    assert not repository.pending_update

    repository = HacsRepository()
    repository.data.installed = True
    repository.data.default_branch = "main"
    repository.data.selected_tag = "main"
    assert not repository.pending_update

    repository.data.installed_commit = "1"
    repository.data.last_commit = "2"
    assert repository.pending_update
